<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "=== Sending Test Email to arisman.henry@gmail.com ===\n\n";

// Check configuration
echo "Current Configuration:\n";
echo "- Default Mailer: " . config('mail.default') . "\n";
echo "- From Address: " . config('mail.from.address') . "\n";
echo "- From Name: " . config('mail.from.name') . "\n";
echo "- Brevo API Key: " . (config('services.brevo.key') ? 'Set' : 'Not set') . "\n\n";

// Test with your actual email
echo "Sending email to arisman.henry@gmail.com...\n";

try {
    $result = Mail::raw('This is a test email from your Laravel application (KIW CMS). If you receive this, your mail configuration is working correctly!', function ($message) {
        $message->to('arisman.henry@gmail.com')
                ->from(config('mail.from.address'), config('mail.from.name'))
                ->subject('Test Email from KIW CMS - ' . date('Y-m-d H:i:s'));
    });
    
    echo "✓ Email queued for sending successfully!\n";
    echo "✓ Mail transport result: " . (is_object($result) ? get_class($result) : 'No result object') . "\n";
    
} catch (Exception $e) {
    echo "✗ Error sending email: " . $e->getMessage() . "\n";
    echo "✗ Error type: " . get_class($e) . "\n";
    
    // Check if it's the IP restriction error
    if (strpos($e->getMessage(), 'unrecognised IP address') !== false) {
        echo "\n⚠️  This is the IP restriction error from Brevo!\n";
        echo "Solution: Add your current IP to Brevo's authorized IPs\n";
        echo "Go to: https://app.brevo.com/security/authorised_ips\n";
    }
}

echo "\n=== Test Complete ===\n";
echo "If you don't receive the email within a few minutes:\n";
echo "1. Check your spam/junk folder\n";
echo "2. Verify the IP restriction issue mentioned above\n";
echo "3. Check if Brevo account has sufficient credits\n";