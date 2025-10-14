@pushOnce('before_head_close')
    @if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile')
        @turnstileScripts()
    @endif
@endPushOnce

<div>
    <!--form-->
    <form wire:submit.prevent="submit" class="flex flex-col sm:flex-row sm:flex-wrap sm:justify-center gap-5">
        <div class="sm:w-[100%] lg:w-[100%]">
            <label for="name" class="hidden">{{ __('whistleblowing.name') }}</label>
            <input type="text" id="name" placeholder="{{ __('whistleblowing.full_name') }}" required
                class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                wire:model="name">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:w-[48.5%] lg:w-[49%]">
            <label for="email" class="hidden">{{ __('whistleblowing.email') }}</label>
            <input type="email" id="email" placeholder="{{ __('whistleblowing.email_placeholder') }}" required
                class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                wire:model="email">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:w-[48.5%] lg:w-[49%]">
            <label for="phone" class="hidden">{{ __('whistleblowing.phone') }}</label>
            <input type="tel" id="phone" placeholder="{{ __('whistleblowing.phone_number') }}" required pattern="[0-9]+" inputmode="numeric"
                class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                wire:model="phone">
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:w-full">
            <label for="comment" class="hidden">{{ __('whistleblowing.comment') }}</label>
            <textarea id="comment" rows="8" placeholder="{{ __('whistleblowing.write_message') }}" required
                class="w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('message') border-red-500 @enderror"
                wire:model="message"></textarea>
            @error('message')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Hidden field to track source page --}}
        <input type="hidden" wire:model="source_page">

        @if ($this->isBotProtectionEnabled())
            <div class="w-full flex justify-center mt-4">
                @if ($this->getBotProtectionType() === 'captcha')
                    <div wire:ignore>
                        {!! NoCaptcha::display() !!}
                    </div>
                @elseif ($this->getBotProtectionType() === 'turnstile')
                    <x-turnstile wire:model="turnstile" />
                @endif
            </div>
        @endif
        @error('captcha')
            <span class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
        @enderror
        @error('turnstile')
            <span class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
        @enderror

        @error('form')
            <span class="text-red-500 text-sm w-full text-center">{{ $message }}</span>
        @enderror

        <!--Button-->
        @if (!$formSubmitted)
            <div class="w-full flex justify-center">
                <button type="submit" class="w-fit btn1 mt-5 flex items-center gap-2 text-white self-center"
                    wire:loading.attr="disabled" wire:target="submit" id="submit-button">
                    <span wire:loading.remove wire:target="submit">{{ __('whistleblowing.submit') }}</span>
                    <span wire:loading wire:target="submit">{{ __('whistleblowing.submitting') }}</span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </div>
        @endif
    </form>

    {{-- Success Message --}}
    @if ($showSuccess)
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg mt-4" role="alert">
            {{ __('sumimasen-cms::submission-form.success_message') }}
        </div>
    @endif

    {{-- JavaScript sections --}}
    @if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'captcha')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('reset-captcha', () => {
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }
                });
            });
        </script>
    @endif

    @if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile')
        <script>
            // Track if form has been submitted
            let formHasBeenSubmitted = @json($formSubmitted);

            document.addEventListener('livewire:init', function () {
                // Listen for successful submission
                Livewire.on('form-submitted-successfully', () => {
                    formHasBeenSubmitted = true;
                    const submitButton = document.getElementById('submit-button');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.style.opacity = '0.6';
                        submitButton.style.cursor = 'not-allowed';
                    }
                });

                // Reset Turnstile when needed
                Livewire.on('reset-turnstile', () => {
                    if (typeof turnstile !== 'undefined') {
                        // Find all turnstile widgets and reset them
                        const widgets = document.querySelectorAll('.cf-turnstile');
                        widgets.forEach(widget => {
                            turnstile.reset(widget);
                        });
                    }
                });

                // Handle form submission errors
                Livewire.on('form-error', () => {
                    // Log for debugging
                    console.log('Form error occurred');
                });
            });

            // Check if form was already submitted on page load
            document.addEventListener('DOMContentLoaded', function () {
                if (formHasBeenSubmitted) {
                    const submitButton = document.getElementById('submit-button');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.style.opacity = '0.6';
                        submitButton.style.cursor = 'not-allowed';
                    }
                }
            });
        </script>
    @else
        <script>
            // For non-Turnstile forms, handle button disable after submission
            document.addEventListener('livewire:init', function () {
                Livewire.on('form-submitted-successfully', () => {
                    const submitButton = document.getElementById('submit-button');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.style.opacity = '0.6';
                        submitButton.style.cursor = 'not-allowed';
                    }
                });
            });

            // Check if form was already submitted on page load
            document.addEventListener('DOMContentLoaded', function () {
                if (@json($formSubmitted)) {
                    const submitButton = document.getElementById('submit-button');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.style.opacity = '0.6';
                        submitButton.style.cursor = 'not-allowed';
                    }
                }
            });
        </script>
    @endif

    <script>
        document.addEventListener('livewire:init', function () {
            Livewire.on('hide-success-after-delay', () => {
                setTimeout(() => {
                    @this.call('hideSuccess');
                }, 5000);
            });
        });
    </script>
</div>