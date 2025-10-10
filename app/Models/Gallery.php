<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'media',
        'type',
        'month',
        'year',
        'status',
        'menu_order',
    ];

    protected $casts = [
        'media' => 'array',
        'month' => 'integer',
        'year' => 'integer',
        'menu_order' => 'integer',
    ];

    // Get media items from Curator
    public function getMediaItemsAttribute()
    {
        if (empty($this->media)) {
            return collect([]);
        }

        return \Awcodes\Curator\Models\Media::whereIn('id', $this->media)->get();
    }

    // Get first media item for thumbnail
    public function getFirstMediaAttribute()
    {
        if (empty($this->media)) {
            return null;
        }

        return \Awcodes\Curator\Models\Media::find($this->media[0]);
    }

    // Scopes for filtering
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeOfType($query, ?string $type)
    {
        if (empty($type)) {
            return $query;
        }

        return $query->where('type', $type);
    }

    public function scopeOfMonth($query, int $month)
    {
        return $query->where('month', $month);
    }

    public function scopeOfYear($query, int $year)
    {
        return $query->where('year', $year);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('menu_order', 'asc')
            ->orderBy('created_at', 'desc');
    }

    // Accessor for formatted month name
    public function getMonthNameAttribute(): string
    {
        return date('F', mktime(0, 0, 0, $this->month, 1));
    }

    // Accessor for display date
    public function getDateDisplayAttribute(): string
    {
        return $this->month_name . ' ' . $this->year;
    }

    // Check if gallery is published
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    // Check if gallery is draft
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }
}

