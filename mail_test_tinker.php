<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "=== Mail Test (Tinker Style) ===\n\n";

// Check configuration
echo "Current Configuration:\n";
echo "- Default Mailer: " . config('mail.default') . "\n";
echo "- From Address: " . config('mail.from.address') . "\n";
echo "- From Name: " . config('mail.from.name') . "\n\n";

// Test 1: Log Mailer
echo "Test 1: Sending email to log...\n";
config(['mail.default' => 'log']);
Mail::raw('This is a test email logged instead of sent.', function ($message) {
    $message->to('arisman.henry@gmail.com')
            ->subject('Test Email (Logged)');
});
echo "✓ Email logged successfully!\n\n";

// Test 2: Brevo Mailer (will likely fail due to IP restriction)
echo "Test 2: Sending email via Brevo...\n";
config(['mail.default' => 'brevo']);
try {
    Mail::raw('This is a test email from your Laravel application.', function ($message) {
        $message->to('your-email@example.com')
                ->subject('Test Email from Laravel (Brevo)');
    });
    echo "✓ Email sent successfully via Brevo!\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Note: You need to add your IP to Brevo's authorized IPs\n";
    echo "Go to: https://app.brevo.com/security/authorised_ips\n";
}

echo "\n=== Test Complete ===\n";