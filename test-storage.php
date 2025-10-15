<?php

require 'vendor/autoload.php';

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemManager;

// Boot Laravel application
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// --- Test listing the bucket ---
try {
    $files = Storage::disk('s3')->allFiles('/');
    echo "✅ Connection successful!\n";
    print_r($files);
} catch (\Exception $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
}

// --- Test uploading a file ---
try {
    $success = Storage::disk('s3')->put('test-file.txt', 'Hello from Laravel Storage!');
    if ($success) {
        echo "✅ Upload success\n";
        $url = Storage::disk('s3')->url('test-file.txt');
        echo "File URL: " . $url . "\n";
    } else {
        echo "❌ Upload failed: returned false\n";
    }
} catch (\Exception $e) {
    echo "❌ Upload failed: " . $e->getMessage() . "\n";
}

// --- Test reading the file back ---
try {
    $content = Storage::disk('s3')->get('test-file.txt');
    echo "✅ File content:\n";
    echo $content . "\n";
} catch (\Exception $e) {
    echo "❌ Could not read file: " . $e->getMessage() . "\n";
}
