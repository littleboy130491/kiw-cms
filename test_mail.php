<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "Testing Mail Configuration\n";
echo "========================\n";
echo 'Mail Mailer: ' . config('mail.default') . "\n";
echo 'From Address: ' . config('mail.from.address') . "\n";
echo 'From Name: ' . config('mail.from.name') . "\n";
echo 'Brevo API Key: ' . (config('services.brevo.key') ? 'Set' : 'Not set') . "\n\n";

// Test sending a simple email
echo "Sending test email...\n";

try {
    Mail::raw('This is a test email from your Laravel application.', function ($message) {
        $message->to('test@example.com')
                ->subject('Test Email from Laravel');
    });
    
    echo "Email sent successfully!\n";
} catch (Exception $e) {
    echo "Error sending email: " . $e->getMessage() . "\n";
    echo "Error details: " . $e->getTraceAsString() . "\n";
}