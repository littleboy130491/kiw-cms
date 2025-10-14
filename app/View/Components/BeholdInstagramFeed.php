<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;

/**
 * Class BeholdInstagramFeed
 */
class BeholdInstagramFeed extends Component
{
    public $feeds;

    public $type;

    public $columns;

    public $limit;

    public $showCaption;

    public $showLikes;

    public $showTimestamp;

    /**
     * @param  string  $type
     * @param  int  $columns
     * @param  int|null  $limit
     * @param  bool  $showCaption
     * @param  bool  $showLikes
     * @param  bool  $showTimestamp
     */
    public function __construct(
        $type = 'all',
        $columns = 3,
        $limit = null,
        $showCaption = false,
        $showLikes = false,
        $showTimestamp = false
    ) {
        $beholdEndpoint = env('BEHOLD_JSON_ENDPOINT');
        
        if (!$beholdEndpoint) {
            $this->feeds = [];
            $this->type = $type;
            $this->columns = (int) $columns;
            $this->limit = $limit;
            $this->showCaption = (bool) $showCaption;
            $this->showLikes = (bool) $showLikes;
            $this->showTimestamp = (bool) $showTimestamp;
            return;
        }

        $cacheKey = 'instagram_feeds_behold_' . md5($beholdEndpoint);
        $rawData = Cache::remember($cacheKey, now()->addMinutes(15), function () use ($beholdEndpoint) {
            $response = Http::get($beholdEndpoint);
            if ($response->successful()) {
                return $response->json();
            }
            return null;
        });

        $feeds = [];
        if ($rawData && isset($rawData['posts'])) {
            $feeds = $this->transformBeholdData($rawData['posts']);
        }

        if ($type !== 'all') {
            $mediaType = strtoupper($type);
            $feeds = array_filter($feeds, function ($item) use ($mediaType) {
                if ($mediaType === 'REEL') {
                    return $item['media_type'] === 'VIDEO' && (isset($item['isReel']) && $item['isReel']);
                }

                return $item['media_type'] === $mediaType;
            });
        }

        // Apply limit if specified
        if ($limit && is_numeric($limit)) {
            $feeds = array_slice($feeds, 0, (int) $limit);
        }

        $this->feeds = array_values($feeds); // Re-index array after filtering
        $this->type = $type;
        $this->columns = (int) $columns;
        $this->limit = $limit;
        $this->showCaption = (bool) $showCaption;
        $this->showLikes = (bool) $showLikes;
        $this->showTimestamp = (bool) $showTimestamp;
    }

    /**
     * Transform Behold data to match the expected format
     */
    private function transformBeholdData($posts)
    {
        $transformed = [];
        
        foreach ($posts as $post) {
            // Get appropriate image sizes from Behold
            $mediaUrl = null;
            $thumbnailUrl = null;
            
            if (isset($post['sizes'])) {
                // Use large size for main display for better quality
                $mediaUrl = $post['sizes']['large']['mediaUrl'] ?? $post['sizes']['medium']['mediaUrl'] ?? $post['mediaUrl'] ?? null;
                // Use medium size for thumbnail
                $thumbnailUrl = $post['sizes']['medium']['mediaUrl'] ?? $post['sizes']['small']['mediaUrl'] ?? $post['thumbnailUrl'] ?? null;
            } else {
                // Fallback to original URLs
                $mediaUrl = $post['mediaUrl'] ?? $post['thumbnailUrl'] ?? null;
                $thumbnailUrl = $post['thumbnailUrl'] ?? $post['mediaUrl'] ?? null;
            }
            
            $feedItem = [
                'id' => $post['id'],
                'media_type' => $post['mediaType'],
                'media_url' => $mediaUrl,
                'thumbnail_url' => $thumbnailUrl,
                'permalink' => $post['permalink'],
                'timestamp' => $post['timestamp'],
                'caption' => $post['caption'] ?? $post['prunedCaption'] ?? null,
                'like_count' => 0, // Behold doesn't provide like count
                'isReel' => $post['isReel'] ?? false,
                'sizes' => $post['sizes'] ?? null, // Pass through sizes for potential use
            ];
            
            // Handle carousel albums
            if ($post['mediaType'] === 'CAROUSEL_ALBUM' && isset($post['children'])) {
                // Use the first child's media as the main media
                $firstChild = $post['children'][0];
                if (isset($firstChild['sizes'])) {
                    $feedItem['media_url'] = $firstChild['sizes']['large']['mediaUrl'] ?? $firstChild['sizes']['medium']['mediaUrl'] ?? $firstChild['mediaUrl'];
                    $feedItem['thumbnail_url'] = $firstChild['sizes']['medium']['mediaUrl'] ?? $firstChild['sizes']['small']['mediaUrl'] ?? $firstChild['mediaUrl'];
                } else {
                    $feedItem['media_url'] = $firstChild['mediaUrl'];
                    $feedItem['thumbnail_url'] = $firstChild['mediaUrl'];
                }
            }
            
            $transformed[] = $feedItem;
        }
        
        return $transformed;
    }

    public function render()
    {
        return view('components.behold-instagram-feed');
    }
}