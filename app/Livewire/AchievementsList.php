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
        $this->search = '';
        $this->selectedType = '';
        $this->selectedYear = '';
        $this->resetPage();
    }

    public function render()
    {
        $achievements = Achievement::query()
            ->with(['featuredImage', 'achievementType', 'achievementYear'])
            ->where('status', 'published')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%");
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
