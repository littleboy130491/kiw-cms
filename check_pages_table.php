<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Check table structure
$columns = \Illuminate\Support\Facades\Schema::getColumnListing('pages');

echo "Pages table columns:\n";
foreach ($columns as $column) {
    echo "- $column\n";
}

// Find the page and see its structure
$page = \App\Models\Page::find(1);
if ($page) {
    echo "\nPage data structure:\n";
    $attributes = $page->getAttributes();
    foreach ($attributes as $key => $value) {
        echo "- $key: " . (is_string($value) ? substr($value, 0, 50) . (strlen($value) > 50 ? '...' : '') : gettype($value)) . "\n";
    }
}