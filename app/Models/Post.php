<?php

namespace App\Models;

use Littleboy130491\Sumimasen\Models\Post as BasePost;

class Post extends BasePost
{
    protected $casts = [
        'custom_fields' => 'array',
        'menu_order' => 'integer',
        'featured' => 'boolean',
        'status' => \Littleboy130491\Sumimasen\Enums\ContentStatus::class,
        'gallery' => 'array',
        'published_at' => 'datetime',
    ];
}
