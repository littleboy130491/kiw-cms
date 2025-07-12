<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Littleboy130491\SeoSuite\Models\Traits\InteractsWithSeoSuite;
use Littleboy130491\Sumimasen\Enums\ContentStatus;
use Spatie\Translatable\HasTranslations;
use Datlechin\FilamentMenuBuilder\Concerns\HasMenuPanel;
use Datlechin\FilamentMenuBuilder\Contracts\MenuPanelable;

class Commercial extends Model implements MenuPanelable
{
    use HasFactory, HasTranslations, SoftDeletes, InteractsWithSeoSuite, HasMenuPanel;

    public const STATUS_OPTIONS = ['draft' => 'Draft', 'published' => 'Published', 'scheduled' => 'Scheduled'];


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
        'gallery',
        'menu_order',
        'published_at',
        'slug',
        'specification',
        'status',
        'template',
        'title',
        'whatsapp',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'custom_fields' => 'array',
        'gallery' => 'array',
        'specification' => 'array',
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
        'specification',
    ];

    public function getMenuPanelTitleColumn(): string
    {
        return 'title';
    }

    public function getMenuPanelUrlUsing(): callable
    {
        $content_model_slug = config('cms.content_models.commercials.slug', 'commercials');
        $locale = app()->getLocale();
        return fn(self $model) => '/' . $locale . '/' . $content_model_slug . '/' . $model->slug;
    }

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

}
