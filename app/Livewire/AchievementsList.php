<?php

namespace App\Livewire;

use App\Models\Achievement;
use App\Models\AchievementType;
use App\Models\AchievementYear;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

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

    protected $rules = [
        'search' => 'nullable|string|max:100|regex:/^[a-zA-Z0-9\s\-\.]+$/',
        'selectedType' => 'nullable|integer|exists:achievement_types,id',
        'selectedYear' => 'nullable|integer|exists:achievement_years,id',
    ];

    public function mount()
    {
        // Sanitize query string parameters on mount
        $this->search = Str::limit(strip_tags($this->search), 100);
        $this->selectedType = (int) $this->selectedType;
        $this->selectedYear = (int) $this->selectedYear;
    }

    public function updatedSearch($value)
    {
        $this->search = Str::limit(strip_tags($value), 100);
        $this->validateOnly('search');
        $this->resetPage();
    }

    public function updatedSelectedType($value)
    {
        $this->selectedType = (int) $value;
        $this->validateOnly('selectedType');
        $this->resetPage();
    }

    public function updatedSelectedYear($value)
    {
        $this->selectedYear = (int) $value;
        $this->validateOnly('selectedYear');
        $this->resetPage();
    }

    public function selectType($typeId)
    {
        $this->selectedType = (int) $typeId;
        $this->validateOnly('selectedType');
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedType', 'selectedYear']);
        $this->resetPage();
        $this->dispatch('reset-filters');
    }

    public function render()
    {
        $allowedLanguages = config('cms.language_available', []);
        $currentLang = app()->getLocale();
        $defaultLang = config('cms.default_language', 'en');

        // Validate language codes
        if (config('cms.multilanguage_enabled') && !in_array($currentLang, $allowedLanguages)) {
            $currentLang = $defaultLang;
        }

        $achievements = Achievement::query()
            ->with(['featuredImage', 'achievementType', 'achievementYear'])
            ->where('status', 'published')
            ->when($this->search, function ($query) use ($currentLang, $defaultLang) {
                $search = $this->search;
                $query->where(function ($q) use ($currentLang, $defaultLang, $search) {
                    $q->whereRaw(
                        'LOWER(JSON_EXTRACT(title, ?)) LIKE LOWER(?)',
                        ['$.' . $currentLang, '%' . $search . '%']
                    )
                        ->orWhereRaw(
                            'LOWER(JSON_EXTRACT(title, ?)) LIKE LOWER(?)',
                            ['$.' . $defaultLang, '%' . $search . '%']
                        );
                });
            })
            ->when($this->selectedType, function ($query) {
                // Use whereHas for relationship filtering
                $query->whereHas('achievementType', function ($q) {
                    $q->where('achievement_types.id', $this->selectedType);
                });
            })
            ->when($this->selectedYear, function ($query) {
                // Use whereHas for relationship filtering
                $query->whereHas('achievementYear', function ($q) {
                    $q->where('achievement_years.id', $this->selectedYear);
                });
            })
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
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