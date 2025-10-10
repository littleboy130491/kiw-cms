<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GalleryList extends Component
{
    public string $activeTab = 'images';
    public ?int $selectedMonth = null;
    public ?int $selectedYear = null;
    public int $perPage = 12;
    public int $page = 1;

    protected $queryString = [
        'activeTab' => ['except' => 'images'],
        'selectedMonth' => ['except' => null],
        'selectedYear' => ['except' => null],
    ];

    public function mount()
    {
        // Initialize with current filters
    }

    public function updatedActiveTab()
    {
        $this->resetPagination();
    }

    public function updatedSelectedMonth()
    {
        $this->resetPagination();
    }

    public function updatedSelectedYear()
    {
        $this->resetPagination();
    }

    public function resetPagination()
    {
        $this->page = 1;
    }

    public function loadMore()
    {
        $this->page++;
    }

    public function resetFilters()
    {
        $this->selectedMonth = null;
        $this->selectedYear = null;
        $this->resetPagination();
    }

    public function getMediaItemsProperty()
    {
        $galleries = Gallery::query()
            ->published()
            ->ofType($this->activeTab)
            ->latest();

        if ($this->selectedMonth) {
            $galleries->ofMonth($this->selectedMonth);
        }

        if ($this->selectedYear) {
            $galleries->ofYear($this->selectedYear);
        }

        // Get all galleries and extract their media
        $allGalleries = $galleries->get();
        $mediaIds = [];

        foreach ($allGalleries as $gallery) {
            if (is_array($gallery->media)) {
                $mediaIds = array_merge($mediaIds, $gallery->media);
            }
        }

        // Get media items and paginate
        $allMedia = \Awcodes\Curator\Models\Media::whereIn('id', $mediaIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // Manual pagination
        return $allMedia->take($this->perPage * $this->page);
    }

    public function getAvailableMonthsProperty()
    {
        return Gallery::query()
            ->published()
            ->ofType($this->activeTab)
            ->when($this->selectedYear, fn($q) => $q->ofYear($this->selectedYear))
            ->distinct()
            ->orderBy('month')
            ->pluck('month')
            ->mapWithKeys(fn($month) => [$month => date('F', mktime(0, 0, 0, $month, 1))])
            ->toArray();
    }

    public function getAvailableYearsProperty()
    {
        return Gallery::query()
            ->published()
            ->ofType($this->activeTab)
            ->when($this->selectedMonth, fn($q) => $q->ofMonth($this->selectedMonth))
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year', 'year')
            ->toArray();
    }

    public function getHasMoreProperty()
    {
        $galleries = Gallery::query()
            ->published()
            ->ofType($this->activeTab)
            ->when($this->selectedMonth, fn($q) => $q->ofMonth($this->selectedMonth))
            ->when($this->selectedYear, fn($q) => $q->ofYear($this->selectedYear))
            ->get();

        $totalMedia = 0;
        foreach ($galleries as $gallery) {
            if (is_array($gallery->media)) {
                $totalMedia += count($gallery->media);
            }
        }

        return $totalMedia > ($this->perPage * $this->page);
    }

    public function render()
    {
        return view('livewire.gallery-list', [
            'mediaItems' => $this->mediaItems,
            'availableMonths' => $this->availableMonths,
            'availableYears' => $this->availableYears,
            'hasMore' => $this->hasMore,
        ]);
    }
}