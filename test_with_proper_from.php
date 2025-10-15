<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "=== Testing with Proper From Address ===\n\n";

// Test with a proper from address that should work with Brevo
$properFromAddress = 'noreply@kiw.co.id'; // Using your actual domain
$properFromName = 'KIW CMS';

echo "Testing with from address: $properFromAddress\n";
echo "Testing with from name: $properFromName\n\n";

try {
    $result = Mail::raw('This is a test email from KIW CMS using a proper from address. If you receive this, the issue was with the from address configuration.', function ($message) use ($properFromAddress, $properFromName) {
        $message->from($properFromAddress, $properFromName)
                ->to('arisman.henry@gmail.com')
                ->subject('Test Email - Proper From Address - ' . date('Y-m-d H:i:s'));
    });
    
    echo "✓ Email sent successfully with proper from address!\n";
    echo "✓ Check your inbox at arisman.henry@gmail.com\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    
    // If still fails, try with a generic from address
    echo "\nTrying with generic from address...\n";
    
    try {
        $result = Mail::raw('This is a test email from KIW CMS using a generic from address.', function ($message) {
            $message->from('test@example.com', 'Test Sender')
                    ->to('arisman.henry@gmail.com')
                    ->subject('Test Email - Generic From - ' . date('Y-m-d H:i:s'));
        });
        
        echo "✓ Email sent with generic from address!\n";
    } catch (Exception $e2) {
        echo "✗ Still failed: " . $e2->getMessage() . "\n";
        
        if (strpos($e2->getMessage(), 'IP address') !== false) {
            echo "\n⚠️  This is still the IP restriction issue!\n";
            echo "You MUST add your IP to Brevo: https://app.brevo.com/security/authorised_ips\n";
        }
    }
}

echo "\n=== Test Complete ===\n";