<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tender;
use App\Models\TenderYear;
use Littleboy130491\Sumimasen\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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
        'tenderYear' => 'nullable|integer|exists:tender_years,id',
    ];

    protected $casts = [
        'tenderYear' => 'integer',
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

            if (strlen($searchTerm) >= 2) {
                $locale = app()->getLocale();
                $defaultLang = config('cms.default_language');

                $allowedLanguageKeys = array_keys(config('cms.language_available', []));
                if (config('cms.multilanguage_enabled') && !in_array($locale, $allowedLanguageKeys, true)) {
                    $locale = $defaultLang;
                }

                $searchLocales = collect([$locale, $defaultLang])
                    ->filter()
                    ->unique()
                    ->values();

                $escapedTerm = str_replace(['%', '_'], ['\%', '\_'], $searchTerm);
                $searchLike = '%' . Str::lower($escapedTerm) . '%';

                $query->where(function ($q) use ($searchLocales, $searchLike) {
                    foreach (['title', 'content', 'specification'] as $column) {
                        $q->orWhere(function ($columnQuery) use ($searchLocales, $column, $searchLike) {
                            foreach ($searchLocales as $index => $localeCode) {
                                $method = $index === 0 ? 'whereRaw' : 'orWhereRaw';
                                $columnQuery->{$method}(
                                    "LOWER(JSON_UNQUOTE(JSON_EXTRACT({$column}, ?))) LIKE ?",
                                    ['$.' . $localeCode, $searchLike]
                                );
                            }
                        });
                    }
                });
            }
        }

        return $query;
    }

    private function applyTenderYearFilter(Builder $query): Builder
    {
        if (!empty($this->tenderYear)) {
            $yearId = (int) $this->tenderYear;

            $query->whereHas('tenderYear', function (Builder $q) use ($yearId) {
                $q->where('tender_years.id', $yearId);
            });
        }

        return $query;
    }

    public function getTenderYears()
    {
        return TenderYear::all()
            ->sortByDesc('resolved_title')
            ->values();
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
