<?php
// app/Services/ExtendedInstagramFeed.php

namespace App\Services;

use Yizack\InstagramFeed;

class ExtendedInstagramFeed extends InstagramFeed
{
    private const BASE_URL = "https://graph.instagram.com";
    private const TOKEN_REFRESH_INTERVAL = 86400; // 24 hours in seconds

    private function fetch($path)
    {
        return json_decode(file_get_contents($path), true);
    }

    private function refreshToken()
    {
        $path = $this->getPath();
        $filename = $this->getFilename();
        $filePath = "$path/$filename";
        $date = date("Y-m-d H:i:s");
        $array = ["updated" => $date];

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode($array));
        }

        $updatedJson = $this->fetch($filePath);
        $updatedDate = $updatedJson["updated"] ?? $date;

        if (strtotime($date) - strtotime($updatedDate) > self::TOKEN_REFRESH_INTERVAL) {
            $refresh = $this->fetch(self::BASE_URL . "/refresh_access_token?grant_type=ig_refresh_token&access_token=" . $this->getToken());
            if (!$refresh) {
                error_log("Warning: Failed to refresh token, please check your configuration or generate a new token.");
            }
            file_put_contents($filePath, json_encode($array));
        }
    }

    /**
     * Get Instagram feed with pagination support
     */
    public function getFeed($fields = ["username", "permalink", "timestamp", "caption"], $limit = 25, $maxPosts = 100)
    {
        $this->refreshToken();

        $allData = [];
        $after = null;
        $totalFetched = 0;

        do {
            // Build URL with pagination
            $url = self::BASE_URL . "/me/media?fields=" . implode(",", $fields) . "&limit=" . min($limit, 100) . "&access_token=" . $this->getToken();

            if ($after) {
                $url .= "&after=" . $after;
            }

            $feed = $this->fetch($url);
            $data = $feed["data"] ?? [];

            // Add to results
            $allData = array_merge($allData, $data);
            $totalFetched += count($data);

            // Check for next page
            $after = $feed["paging"]["cursors"]["after"] ?? null;

            // Stop if we've reached maxPosts limit
            if ($maxPosts > 0 && $totalFetched >= $maxPosts) {
                $allData = array_slice($allData, 0, $maxPosts);
                break;
            }

        } while ($after && count($data) > 0);

        return $allData;
    }
}