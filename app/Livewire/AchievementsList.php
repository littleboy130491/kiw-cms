<?php

namespace App\Livewire;

use App\Models\Achievement;
use App\Models\AchievementType;
use App\Models\AchievementYear;
use Livewire\Component;
use Livewire\WithPagination;

class AchievementsList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedType = '';
    public $selectedYear = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedType' => ['except' => ''],
        'selectedYear' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedType()
    {
        $this->resetPage();
    }

    public function updatingSelectedYear()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedType', 'selectedYear']);
        $this->resetPage();
        // Clear the search input
        $this->js('document.querySelector(\'input[type="search"]\').value = ""');
        // Clear the year dropdown
        $this->js('document.querySelectorAll(\'select\')[0].value = ""');
    }

    public function render()
    {
        $achievements = Achievement::query()
            ->with(['featuredImage', 'achievementType', 'achievementYear'])
            ->where('status', 'published')
            ->when($this->search, function ($query) {
                $currentLang = app()->getLocale();
                $defaultLang = config('cms.default_language', 'en');

                $query->where(function ($q) use ($currentLang, $defaultLang) {
                    $q->whereRaw('LOWER(JSON_EXTRACT(title, ?)) LIKE LOWER(?)', ["$.{$currentLang}", "%{$this->search}%"])
                        ->orWhereRaw('LOWER(JSON_EXTRACT(title, ?)) LIKE LOWER(?)', ["$.{$defaultLang}", "%{$this->search}%"]);
                });
            })
            ->when($this->selectedType, function ($query) {
                $query->whereHas('achievementType', function ($q) {
                    $q->where('achievement_types.id', $this->selectedType);
                });
            })
            ->when($this->selectedYear, function ($query) {
                $query->whereHas('achievementYear', function ($q) {
                    $q->where('achievement_years.id', $this->selectedYear);
                });
            })
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $achievementTypes = AchievementType::orderBy('title')->get();
        $achievementYears = AchievementYear::orderBy('title', 'desc')->get();

        return view('livewire.achievements-list', [
            'achievements' => $achievements,
            'achievementTypes' => $achievementTypes,
            'achievementYears' => $achievementYears,
        ]);
    }
}
