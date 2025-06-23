<?php

namespace App\Models;

use App\Models\TenderLocation;
use App\Models\TenderStatus;
use App\Models\TenderYear;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Littleboy130491\SeoSuite\Models\Traits\InteractsWithSeoSuite;
use Spatie\Translatable\HasTranslations;

class Tender extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, InteractsWithSeoSuite;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'custom_fields',
        'due_date',
        'excerpt',
        'featured_image',
        'menu_order',
        'process',
        'published_at',
        'slug',
        'specification',
        'status',
        'template',
        'title'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'custom_fields' => 'array',
        'menu_order' => 'integer',
        'status' => \App\Enums\ContentStatus::class,
        'due_date' => 'datetime',
        'published_at' => 'datetime'
    ];


    /**
     * The attributes that are translatable.
     *
     * @var array<int, string>
     */
    public $translatable = [
        'content',
        'excerpt',
        'process',
        'slug',
        'specification',
        'title'
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
     * Define the tenderYear relationship.
     */
    public function tenderYear(): BelongsToMany
    {
        // Use the base class name for the ::class constant
        // Add foreign key argument if specified in YAML
        return $this->belongsToMany(TenderYear::class);
    }

    /**
     * Define the tenderStatus relationship.
     */
    public function tenderStatus(): BelongsToMany
    {
        // Use the base class name for the ::class constant
        // Add foreign key argument if specified in YAML
        return $this->belongsToMany(TenderStatus::class);
    }

    /**
     * Define the tenderLocation relationship.
     */
    public function tenderLocation(): BelongsToMany
    {
        // Use the base class name for the ::class constant
        // Add foreign key argument if specified in YAML
        return $this->belongsToMany(TenderLocation::class);
    }

}
