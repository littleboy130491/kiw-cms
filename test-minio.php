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
        'key' => '10L1NCAN855YOC4N2S0B',
        'secret' => 'VvCrHHwGdzfZ7k8dg6p5Rn0BqWhTTUroQr0rNj9G',
    ],
]);

try {
    $result = $s3->listBuckets();
    echo "✅ Connection successful!\n";
    print_r($result['Buckets']);
} catch (AwsException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
}

try {
    $result = $s3->putObject([
        'Bucket' => 'kiw',
        'Key' => 'test-file.txt',
        'Body' => 'Hello from AWS SDK',
    ]);
    echo "✅ Upload success\n";
    print_r($result->toArray());
} catch (AwsException $e) {
    echo "❌ Upload failed\n";
    echo $e->getAwsErrorCode() . "\n";
    echo $e->getMessage() . "\n";
}