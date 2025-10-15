<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-1', // arbitrary for MinIO
    'endpoint' => 'https://is3.cloudhost.id',
    'use_path_style_endpoint' => true,
    'credentials' => [
        'key'    => '<ACCESS_KEY>',
        'secret' => '<SECRET_KEY>',
    ],
]);

try {
    $result = $s3->listBuckets();
    echo "✅ Connection successful!\n";
    print_r($result['Buckets']);
} catch (AwsException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
}