<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Littleboy130491\Sumimasen\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Builder;

class PostSearch extends Component
{
    use WithPagination;

    public $searchQuery = '';
    public $relation = '';
    public $slug = '';
    public $currentUrl = '';

    public $content = '';

    protected $queryString = [
        'searchQuery' => ['except' => ''],
    ];

    protected $rules = [
        'searchQuery' => 'nullable|string|max:255',
    ];

    public function mount(array $routeParams = [], string $currentUrl = '', string $content = '')
    {
        $this->relation = $routeParams['taxonomy_key'] ?? '';
        $this->slug = $routeParams['taxonomy_slug'] ?? '';
        $this->currentUrl = $currentUrl;
        $this->content = $content;
    }

    public function updatingSearchQuery()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->searchQuery = '';
        $this->resetPage();
    }

    private function buildBaseQuery(): Builder
    {
        return Post::with(['categories', 'tags', 'featuredImage'])
            ->where('status', ContentStatus::Published)
            ->when($this->slug && $this->relation, function ($query) {
                return $query->whereHas($this->relation, function (Builder $q) {
                    $slug = strtolower(trim($this->slug));
                    $locale = app()->getLocale();
                    $defaultLang = config('cms.default_language');

                    // Validate locales
                    $allowedLocales = config('cms.language_available');
                    if (!in_array($locale, $allowedLocales)) {
                        $locale = $defaultLang;
                    }

                    // Handle Spatie translatable slug lookup
                    $q->where(function ($subQuery) use ($slug, $locale, $defaultLang) {
                        // For Spatie translatable, we need to check the translated value
                        $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(slug, ?))) = ?", ["$.$locale", $slug])
                            ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(slug, ?))) = ?", ["$.$defaultLang", $slug])
                            ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(slug, ?))) = ?", ["$.id", $slug])
                            ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(slug, ?))) = ?", ["$.en", $slug]);
                    });
                });
            })
            ->latest();
    }

    private function applySearchFilter(Builder $query): Builder
    {
        if (!empty($this->searchQuery)) {
            $searchTerm = trim($this->searchQuery);

            // Only search if term is at least 2 characters
            if (strlen($searchTerm) >= 2) {
                $locale = app()->getLocale();
                $defaultLang = config('cms.default_language');

                // Escape LIKE wildcards
                $searchTerm = str_replace(['%', '_'], ['\%', '\_'], $searchTerm);

                $query->where(function ($q) use ($searchTerm, $locale, $defaultLang) {
                    // Build JSON path as parameter
                    $localePath = '$.' . $locale;
                    $defaultPath = '$.' . $defaultLang;

                    // Search in translatable fields
                    $q->where(function ($subQuery) use ($searchTerm, $localePath, $defaultPath) {
                        // Search in title (translatable)
                        $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(title, ?))) LIKE ?", [$localePath, '%' . strtolower($searchTerm) . '%'])
                            ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(title, ?))) LIKE ?", [$defaultPath, '%' . strtolower($searchTerm) . '%']);
                    })
                        ->orWhere(function ($subQuery) use ($searchTerm, $localePath, $defaultPath) {
                            // Search in content (translatable)
                            $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(content, ?))) LIKE ?", [$localePath, '%' . strtolower($searchTerm) . '%'])
                                ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(content, ?))) LIKE ?", [$defaultPath, '%' . strtolower($searchTerm) . '%']);
                        })
                        ->orWhere(function ($subQuery) use ($searchTerm, $localePath, $defaultPath) {
                            // Search in excerpt (translatable)
                            $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(excerpt, ?))) LIKE ?", [$localePath, '%' . strtolower($searchTerm) . '%'])
                                ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(excerpt, ?))) LIKE ?", [$defaultPath, '%' . strtolower($searchTerm) . '%']);
                        });
                });
            }
        }

        return $query;
    }

    protected function getPaginationNumber(): int
    {
        $perPage = config('cms.content_models.posts.per_page') ?? config('cms.pagination_number', 12);
        return max((int) $perPage, 1);
    }

    public function render()
    {
        $query = $this->buildBaseQuery();
        $query = $this->applySearchFilter($query);

        $posts = $query->paginate($this->getPaginationNumber())
            ->withPath($this->currentUrl)
            ->appends(['searchQuery' => $this->searchQuery]);

        return view('livewire.post-search', [
            'posts' => $posts,
        ]);
    }
}