<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "=== Laravel Mail Tinker Test ===\n\n";

// Show current configuration
echo "Current Mail Configuration:\n";
echo "---------------------------\n";
echo 'Default Mailer: ' . config('mail.default') . "\n";
echo 'From Address: ' . config('mail.from.address') . "\n";
echo 'From Name: ' . config('mail.from.name') . "\n";
echo 'Brevo API Key: ' . (config('services.brevo.key') ? 'Set' : 'Not set') . "\n\n";

// Interactive test
echo "Available Commands:\n";
echo "1. Send test email using Brevo\n";
echo "2. Send test email using Log (for testing)\n";
echo "3. Switch mailer to Brevo\n";
echo "4. Switch mailer to Log\n";
echo "5. Exit\n\n";

while (true) {
    echo "Enter command (1-5): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    $choice = trim($line);

    switch ($choice) {
        case '1':
            echo "\nSending test email via Brevo...\n";
            try {
                Mail::raw('This is a test email from your Laravel application sent via Brevo.', function ($message) {
                    $message->to('arisman.henry@gmail.com')
                            ->subject('Test Email from Laravel (Brevo)');
                });
                echo "✓ Email sent successfully!\n";
            } catch (Exception $e) {
                echo "✗ Error: " . $e->getMessage() . "\n";
            }
            break;
            
        case '2':
            echo "\nSending test email to log...\n";
            config(['mail.default' => 'log']);
            try {
                Mail::raw('This is a test email logged instead of sent.', function ($message) {
                    $message->to('test@example.com')
                            ->subject('Test Email (Logged)');
                });
                echo "✓ Email logged successfully! Check storage/logs/laravel.log\n";
            } catch (Exception $e) {
                echo "✗ Error: " . $e->getMessage() . "\n";
            }
            break;
            
        case '3':
            config(['mail.default' => 'brevo']);
            echo "✓ Mailer switched to Brevo\n";
            break;
            
        case '4':
            config(['mail.default' => 'log']);
            echo "✓ Mailer switched to Log\n";
            break;
            
        case '5':
            echo "Goodbye!\n";
            exit;
            
        default:
            echo "Invalid choice. Please enter 1-5.\n";
    }
    echo "\n";
}