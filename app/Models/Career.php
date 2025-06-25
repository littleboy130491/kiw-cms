<?php

namespace App\Models;

use App\Enums\ContentStatus;
use App\Models\CareerCategory;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Littleboy130491\SeoSuite\Models\Traits\InteractsWithSeoSuite;
use Spatie\Translatable\HasTranslations;

class Career extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, InteractsWithSeoSuite;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'cta',
        'custom_fields',
        'excerpt',
        'featured_image',
        'menu_order',
        'published_at',
        'slug',
        'status',
        'template',
        'title',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'custom_fields' => 'array',
        'menu_order' => 'integer',
        'status' => ContentStatus::class,
        'published_at' => 'datetime',
    ];


    /**
     * The attributes that are translatable.
     *
     * @var array<int, string>
     */
    public $translatable = [
        'content',
        'excerpt',
        'slug',
        'title',
    ];



    //--------------------------------------------------------------------------
    // Relationships
    //--------------------------------------------------------------------------

    /**
     * Define the featuredImage relationship to Curator Media.
     */
    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'featured_image', 'id');
    }

    /**
     * Define the careerCategories relationship.
     */
    public function careerCategories(): BelongsToMany
    {
        return $this->belongsToMany(CareerCategory::class);
    }

}
