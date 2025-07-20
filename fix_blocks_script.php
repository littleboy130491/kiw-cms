<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

// Get database connection
$db = $app->make('db');

// Get the raw data
$rawData = $db->table('pages')->where('slug->id', 'home')->first();

if ($rawData) {
    $section = json_decode($rawData->section, true);
    
    echo "Current section structure:\n";
    foreach ($section as $key => $value) {
        echo "Key: $key\n";
        if (is_array($value) && !empty($value)) {
            if (isset($value['type'])) {
                echo "  - Single block type: {$value['type']}\n";
            } else {
                echo "  - Array with " . count($value) . " items\n";
                if (isset($value[0]['type'])) {
                    echo "    First item type: {$value[0]['type']}\n";
                }
            }
        }
    }
    
    // Fix the structure if needed
    $blocksData = [];
    foreach ($section as $key => $value) {
        if (is_numeric($key) && is_array($value) && isset($value['type'])) {
            $blocksData[] = $value;
        }
    }
    
    if (!empty($blocksData)) {
        echo "\nFound " . count($blocksData) . " blocks to fix\n";
        
        // Define the IDs for each section in order
        $blockIds = [
            'hero-banner',      // slider
            'hero-counters',    // counters
            'about',            // content_with_media
            'about-counters',   // counters
            'services',         // section_with_items - services
            'advantages',       // section_with_items - advantages
            'industry-tabs',    // tabbed_content
            'facilities',       // text_section - facilities
            'video-section',    // video_embed
            'tenant-logos',     // logo_grid
            'news-articles',    // text_section - news
            'investor-relations' // text_section - investor
        ];
        
        // Add IDs to blocks
        foreach ($blocksData as $index => &$block) {
            if (isset($blockIds[$index])) {
                $block['data']['id'] = $blockIds[$index];
            }
        }
        
        // Create correct structure
        $newSection = ['id' => $blocksData];
        
        // Update database
        $db->table('pages')
            ->where('id', $rawData->id)
            ->update(['section' => json_encode($newSection)]);
            
        echo "Fixed section structure and added IDs\n";
        
        // Verify
        foreach ($blocksData as $index => $block) {
            echo "Block $index - Type: {$block['type']}, ID: " . ($block['data']['id'] ?? 'none') . "\n";
        }
    } else {
        echo "No blocks found to fix\n";
    }
} else {
    echo "No page found\n";
}