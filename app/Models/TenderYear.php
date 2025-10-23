<?php

namespace App\Models;

use App\Models\Tender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Littleboy130491\SeoSuite\Models\Traits\InteractsWithSeoSuite;
use Spatie\Translatable\HasTranslations;

class TenderYear extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, InteractsWithSeoSuite;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_order',
        'slug',
        'template',
        'title',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'menu_order' => 'integer',
    ];


    /**
     * The attributes that are translatable.
     *
     * @var array<int, string>
     */
    public $translatable = [
        'slug',
        'title',
    ];

    /**
     * Resolve the translated title with manual fallbacks.
     */
    public function getResolvedTitleAttribute(): string
    {
        $currentLocale = app()->getLocale();
        $defaultLocale = config('cms.default_language', config('app.fallback_locale'));

        $title = $this->getTranslation('title', $currentLocale, false);

        if (blank($title) && $defaultLocale) {
            $title = $this->getTranslation('title', $defaultLocale, false);
        }

        if (blank($title)) {
            $title = collect($this->getTranslations('title'))
                ->first(fn ($value) => filled($value));
        }

        return $title ?? '';
    }



    //--------------------------------------------------------------------------
    // Relationships
    //--------------------------------------------------------------------------

    /**
     * Define the tenders relationship.
     */
    public function tenders(): BelongsToMany
    {
        return $this->belongsToMany(Tender::class);
    }

}
