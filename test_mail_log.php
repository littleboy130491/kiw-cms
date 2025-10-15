<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "Testing Mail with Log Mailer\n";
echo "============================\n";

// Temporarily switch to log mailer for testing
config(['mail.default' => 'log']);

echo 'Mail Mailer: ' . config('mail.default') . "\n";
echo 'From Address: ' . config('mail.from.address') . "\n";
echo 'From Name: ' . config('mail.from.name') . "\n\n";

// Test sending a simple email to the log
echo "Sending test email to log...\n";

try {
    Mail::raw('This is a test email from your Laravel application.', function ($message) {
        $message->to('test@example.com')
                ->subject('Test Email from Laravel');
    });
    
    echo "Email logged successfully!\n";
    echo "Check your Laravel log file at storage/logs/laravel.log to see the email content.\n";
} catch (Exception $e) {
    echo "Error logging email: " . $e->getMessage() . "\n";
}