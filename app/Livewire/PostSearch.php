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

    protected $queryString = [
        'searchQuery' => ['except' => ''],
    ];

    protected $rules = [
        'searchQuery' => 'nullable|string|max:255',
    ];

    public function mount(array $routeParams = [], string $currentUrl = '')
    {
        $this->relation = $routeParams['taxonomy_key'] ?? '';
        $this->slug = $routeParams['taxonomy_slug'] ?? '';
        $this->currentUrl = $currentUrl;
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

                    // Case-insensitive JSON search
                    $q->where(function ($subQuery) use ($slug, $locale, $defaultLang) {
                        $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(slug, '$.{$locale}'))) = ?", [$slug])
                            ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(slug, '$.{$defaultLang}'))) = ?", [$slug]);
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

                $query->where(function ($q) use ($searchTerm, $locale, $defaultLang) {
                    // Case-insensitive search for translatable fields
                    $q->where(function ($subQuery) use ($searchTerm, $locale, $defaultLang) {
                        // Search in title (translatable)
                        $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(title, '$.{$locale}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%'])
                            ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(title, '$.{$defaultLang}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%']);
                    })
                        ->orWhere(function ($subQuery) use ($searchTerm, $locale, $defaultLang) {
                            // Search in content (translatable)
                            $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(content, '$.{$locale}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%'])
                                ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(content, '$.{$defaultLang}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%']);
                        })
                        ->orWhere(function ($subQuery) use ($searchTerm, $locale, $defaultLang) {
                            // Search in excerpt (translatable)
                            $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(excerpt, '$.{$locale}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%'])
                                ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(excerpt, '$.{$defaultLang}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%']);
                        });
                });
            }
        }

        return $query;
    }

    public function render()
    {
        $query = $this->buildBaseQuery();
        $query = $this->applySearchFilter($query);

        $posts = $query->paginate(12)
            ->withPath($this->currentUrl)
            ->appends(['searchQuery' => $this->searchQuery]);

        return view('livewire.post-search', [
            'posts' => $posts,
        ]);
    }
}