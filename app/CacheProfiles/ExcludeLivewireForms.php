<?php

namespace App\CacheProfiles;

use Spatie\ResponseCache\CacheProfiles\CacheAllSuccessfulGetRequests;
use Illuminate\Http\Request;

class ExcludeLivewireForms extends CacheAllSuccessfulGetRequests
{
    public function shouldCacheRequest(Request $request): bool
    {
        // Don't cache Livewire requests
        if ($request->header('X-Livewire')) {
            return false;
        }

        // Don't cache contact page (or any page with forms)
        if ($request->is('contact', 'kontak', 'contact/*', 'kontak/*')) {
            return false;
        }

        // Don't cache if Turnstile data is present
        if ($request->has('turnstile') || $request->has('cf-turnstile-response')) {
            return false;
        }

        return parent::shouldCacheRequest($request);
    }
}