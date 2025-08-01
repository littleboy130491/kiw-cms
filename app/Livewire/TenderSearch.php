<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tender;
use App\Models\TenderYear;
use Littleboy130491\Sumimasen\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Builder;

class TenderSearch extends Component
{
    use WithPagination;

    public $searchQuery = '';
    public $tenderYear = '';
    public $currentUrl = '';

    public $content = '';

    protected $queryString = [
        'searchQuery' => ['except' => ''],
        'tenderYear' => ['except' => ''],
    ];

    protected $rules = [
        'searchQuery' => 'nullable|string|max:255',
        'tenderYear' => 'nullable|string|max:255',
    ];

    public function mount(string $currentUrl = '', string $content = '')
    {
        $this->currentUrl = $currentUrl;
        $this->content = $content;
    }

    public function updatingSearchQuery()
    {
        $this->resetPage();
    }

    public function updatingTenderYear()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->searchQuery = '';
        $this->tenderYear = '';
        $this->resetPage();

        $this->dispatch('reset-filters');
    }

    private function buildBaseQuery(): Builder
    {
        return Tender::with(['tenderYear', 'tenderStatus', 'tenderLocation'])
            ->where('status', ContentStatus::Published)
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

                // Validate locales
                $allowedLocales = config('cms.language_available', ['en']);
                if (!in_array($locale, $allowedLocales)) {
                    $locale = $defaultLang;
                }

                // Escape LIKE wildcards
                $searchTerm = str_replace(['%', '_'], ['\%', '\_'], $searchTerm);

                $query->where(function ($q) use ($searchTerm, $locale, $defaultLang) {
                    // Build JSON path as parameter
                    $localePath = '$.' . $locale;
                    $defaultPath = '$.' . $defaultLang;

                    // Case-insensitive search for translatable fields
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
                            // Search in specification (translatable)
                            $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(specification, ?))) LIKE ?", [$localePath, '%' . strtolower($searchTerm) . '%'])
                                ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(specification, ?))) LIKE ?", [$defaultPath, '%' . strtolower($searchTerm) . '%']);
                        });
                });
            }
        }

        return $query;
    }

    private function applyTenderYearFilter(Builder $query): Builder
    {
        if (!empty($this->tenderYear)) {
            $query->whereHas('tenderYear', function (Builder $q) {
                $locale = app()->getLocale();
                $defaultLang = config('cms.default_language');

                // Validate locales
                $allowedLocales = config('cms.language_available', ['en']);
                if (!in_array($locale, $allowedLocales)) {
                    $locale = $defaultLang;
                }

                // Build JSON path as parameter
                $localePath = '$.' . $locale;
                $defaultPath = '$.' . $defaultLang;

                $q->where(function ($subQuery) use ($localePath, $defaultPath) {
                    $subQuery->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, ?)) = ?", [$localePath, $this->tenderYear])
                        ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, ?)) = ?", [$defaultPath, $this->tenderYear]);
                });
            });
        }

        return $query;
    }

    public function getTenderYears()
    {
        return TenderYear::orderBy('title', 'desc')
            ->get()
            ->mapWithKeys(function ($item) {
                $title = $item->title;
                return [$title => $title];
            })
            ->filter()
            ->toArray();
    }

    protected function getPaginationNumber(): int
    {
        $perPage = config('cms.content_models.tenders.per_page') ?? config('cms.pagination_number', 12);
        return max((int) $perPage, 1);
    }

    public function render()
    {

        $query = $this->buildBaseQuery();
        $query = $this->applySearchFilter($query);
        $query = $this->applyTenderYearFilter($query);

        $tenders = $query->paginate($this->getPaginationNumber())
            ->withPath($this->currentUrl)
            ->appends([
                'searchQuery' => $this->searchQuery,
                'tenderYear' => $this->tenderYear,
            ]);

        return view('livewire.tender-search', [
            'tenders' => $tenders,
            'tenderYears' => $this->getTenderYears(),
        ]);
    }
}