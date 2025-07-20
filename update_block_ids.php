<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Page;

// Get the home page using the correct query
$homePage = Page::where('slug->en', 'home')->first();

if ($homePage) {
    echo "Found home page with ID: {$homePage->id}\n";
    
    $section = $homePage->section;
    $locale = 'id'; // Indonesian locale where our blocks are stored
    
    if (isset($section[$locale]) && is_array($section[$locale])) {
        $blocks = $section[$locale];
        echo "Found " . count($blocks) . " blocks\n";
        
        // Define the block_ids for each section in order
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
        
        // Add block_id to each block
        foreach ($blocks as $index => &$block) {
            if (isset($blockIds[$index])) {
                $block['data']['block_id'] = $blockIds[$index];
                // Remove old 'id' if it exists
                unset($block['data']['id']);
                echo "Updated block {$index} ({$block['type']}) with block_id: {$blockIds[$index]}\n";
            }
        }
        
        // Update the section
        $section[$locale] = $blocks;
        $homePage->section = $section;
        $homePage->save();
        
        echo "Successfully updated all blocks with block_id\n";
        
    } else {
        echo "No blocks found in locale '{$locale}'\n";
        echo "Available locales: " . implode(', ', array_keys($section)) . "\n";
    }
} else {
    echo "No home page found\n";
}