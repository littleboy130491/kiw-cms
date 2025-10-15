<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Transport\AbstractApiTransport;

echo "=== Debugging Brevo Email Delivery ===\n\n";

// Get the transport instance
$mailer = Mail::mailer('brevo');
$transport = $mailer->getSymfonyTransport();

echo "Transport type: " . get_class($transport) . "\n";
echo "Brevo API Key: " . (config('services.brevo.key') ? substr(config('services.brevo.key'), 0, 10) . '...' : 'Not set') . "\n\n";

// Create a test email
$email = new Symfony\Component\Mime\Email();
$email->from(config('mail.from.address'), config('mail.from.name'))
      ->to('arisman.henry@gmail.com')
      ->subject('Debug Test Email from KIW CMS - ' . date('Y-m-d H:i:s'))
      ->text('This is a debug test email. Please check the delivery status.');

echo "Sending email with detailed debugging...\n";

try {
    // Send and get the response
    $sentMessage = $transport->send($email);
    
    echo "✓ Email sent successfully!\n";
    echo "Message ID: " . $sentMessage->getMessageId() . "\n";
    echo "Debug info: " . print_r($sentMessage->getDebug(), true) . "\n";
    
    // Try to get more details from the response
    if (method_exists($sentMessage, 'getOriginalMessage')) {
        echo "Original message available: Yes\n";
    }
    
} catch (Exception $e) {
    echo "✗ Error sending email: " . $e->getMessage() . "\n";
    echo "✗ Error code: " . $e->getCode() . "\n";
    echo "✗ Error type: " . get_class($e) . "\n";
    
    // Check for specific errors
    if (strpos($e->getMessage(), 'IP address') !== false) {
        echo "\n⚠️  IP RESTRICTION DETECTED!\n";
        echo "You need to authorize your IP in Brevo:\n";
        echo "1. Go to https://app.brevo.com/security/authorised_ips\n";
        echo "2. Add your current IP address\n";
        echo "3. Wait a few minutes for the change to take effect\n";
    }
    
    if (strpos($e->getMessage(), 'credits') !== false || strpos($e->getMessage(), 'quota') !== false) {
        echo "\n⚠️  CREDIT/QUOTA ISSUE DETECTED!\n";
        echo "Check your Brevo account credits at https://app.brevo.com\n";
    }
}

echo "\n=== Debug Complete ===\n";