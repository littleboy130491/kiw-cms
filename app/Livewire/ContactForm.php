<?php

namespace App\Livewire;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use Illuminate\Support\Facades\Mail;
use Littleboy130491\Sumimasen\Livewire\SubmissionForm;
use Littleboy130491\Sumimasen\Mail\FormSubmissionNotification;
use Littleboy130491\Sumimasen\Models\Submission;

class ContactForm extends SubmissionForm
{
    public $company = '';

    public function rules()
    {
        $rules = parent::rules();
        $rules['company'] = 'nullable|string|max:255';
        $rules['phone'] = 'required|string|max:50'; // Make phone required
        $rules['message'] = 'required|string|min:10|max:2000';
        return $rules;
    }

    public function submit()
    {
        // Prevent multiple submissions
        if ($this->formSubmitted) {
            return;
        }

        // Handle CSRF token refresh for Turnstile before validation
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
            try {
                // Force regenerate the session token
                session()->regenerateToken();

                // Also refresh the CSRF token in the request
                request()->session()->regenerateToken();

                // Wait a moment for token regeneration
                usleep(100000); // 100ms
            } catch (\Exception $e) {
                $this->addError('form', 'Session error. Please refresh the page and try again.');
                return;
            }
        }

        try {
            $this->validate();
        } catch (\Illuminate\Session\TokenMismatchException $e) {
            // Handle CSRF token mismatch specifically
            $this->addError('form', 'Session expired. Please refresh the page and try again.');
            return;
        } catch (\Exception $e) {
            // Handle other validation errors
            return;
        }

        // Additional bot protection validation for reCAPTCHA
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'captcha') {
            if (!NoCaptcha::verifyResponse($this->captcha, request()->ip())) {
                $this->addError('captcha', __('sumimasen-cms::submission-form.captcha_error'));
                return;
            }
        }

        try {
            // Create submission with all form data
            $submission = Submission::create([
                'fields' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'message' => $this->message,
                    'subject' => 'Contact Form Submission',
                    'phone' => $this->phone,
                    'company' => $this->company,
                    'submitted_at' => now()->toISOString(),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ],
            ]);

            // Send email notification to admin
            $adminEmail = config('cms.form_submission.admin_email');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new FormSubmissionNotification($submission));
            }

            // Mark form as submitted to prevent further submissions
            $this->formSubmitted = true;

            // Show success message
            $this->showSuccess = true;

            // Hide success message after 5 seconds
            $this->dispatch('hide-success-after-delay');

            // Reset bot protection widget if enabled
            if ($this->isBotProtectionEnabled()) {
                $botProtectionType = $this->getBotProtectionType();
                if ($botProtectionType === 'captcha') {
                    $this->dispatch('reset-captcha');
                } elseif ($botProtectionType === 'turnstile') {
                    $this->dispatch('reset-turnstile');
                }
            }

            // Reset form after successful submission
            $this->reset(['name', 'email', 'message', 'subject', 'phone', 'captcha', 'turnstile', 'company']);

        } catch (\Exception $e) {
            // Set error message on component
            $this->addError('form', __('sumimasen-cms::submission-form.submission_error'));
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}