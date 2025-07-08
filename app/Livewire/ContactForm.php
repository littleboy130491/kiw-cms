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

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            $this->dispatch('form-error');
            throw $e; // Re-throw to show validation errors
        }

        // Additional bot protection validation for reCAPTCHA only
        // (Turnstile is handled by the validation rule)
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'captcha') {
            if (!NoCaptcha::verifyResponse($this->captcha, request()->ip())) {
                $this->addError('captcha', __('sumimasen-cms::submission-form.captcha_error'));
                $this->dispatch('form-error');
                $this->dispatch('reset-captcha');
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
            
            // Dispatch event to permanently disable the button
            $this->dispatch('form-submitted-successfully');

            // Reset form after successful submission
            $this->reset(['name', 'email', 'message', 'subject', 'phone', 'captcha', 'turnstile', 'company']);
            
            // Reset bot protection widget after form reset
            if ($this->isBotProtectionEnabled()) {
                $botProtectionType = $this->getBotProtectionType();
                if ($botProtectionType === 'captcha') {
                    $this->dispatch('reset-captcha');
                } elseif ($botProtectionType === 'turnstile') {
                    $this->dispatch('reset-turnstile');
                }
            }

        } catch (\Exception $e) {
            // Set error message on component
            $this->addError('form', __('sumimasen-cms::submission-form.submission_error'));
            $this->dispatch('form-error');
            
            // Log the error for debugging
            \Log::error('Form submission failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}