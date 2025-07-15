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

    protected $queryString = [
        'searchQuery' => ['except' => ''],
        'tenderYear' => ['except' => ''],
    ];

    protected $rules = [
        'searchQuery' => 'nullable|string|max:255',
        'tenderYear' => 'nullable|string',
    ];

    public function mount(string $currentUrl = '')
    {
        $this->currentUrl = $currentUrl;
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
        // Clear the search input
        $this->js('document.querySelector(\'input[type="search"]\').value = ""');
        // Clear the year dropdown
        $this->js('document.querySelectorAll(\'select\')[0].value = ""');
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
                            // Search in specification (translatable)
                            $subQuery->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(specification, '$.{$locale}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%'])
                                ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(specification, '$.{$defaultLang}'))) LIKE ?", ['%' . strtolower($searchTerm) . '%']);
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

                $q->where(function ($subQuery) use ($locale, $defaultLang) {
                    $subQuery->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$.{$locale}')) = ?", [$this->tenderYear])
                        ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$.{$defaultLang}')) = ?", [$this->tenderYear]);
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

    protected function getPaginationNumber(): int {
        return config('cms.content_models.tenders.per_page') ?? config('cms.pagination_number', 12);
    }

    public function render()
    {
        $query = $this->buildBaseQuery();
        $query = $this->applySearchFilter($query);
        $query = $this->applyTenderYearFilter($query);

        $tenders = $query->paginate(12)
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