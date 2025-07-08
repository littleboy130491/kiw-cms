@pushOnce('before_head_close')
    @turnstileScripts()
@endPushOnce

<div>
    @if ($showSuccess)
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ __('sumimasen-cms::submission-form.success_message') }}
        </div>
    @endif

    <!--form-->
    <form wire:submit.prevent="submit" class="flex flex-col sm:flex-row sm:flex-wrap sm:justify-center gap-5">
        <div class="sm:w-[48.5%] lg:w-[49%]">
            <label for="name" class="hidden">Nama</label>
            <input type="text" id="name" placeholder="Nama Lengkap" required
                class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                wire:model.defer="name">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:w-[48.5%] lg:w-[49%]">
            <label for="company" class="hidden">Perusahaan</label>
            <input type="text" id="company" placeholder="Nama Perusahaan"
                class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company') border-red-500 @enderror"
                wire:model.defer="company">
            @error('company')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:w-[48.5%] lg:w-[49%]">
            <label for="email" class="hidden">Email</label>
            <input type="email" id="email" placeholder="Email" required
                class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                wire:model.defer="email">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:w-[48.5%] lg:w-[49%]">
            <label for="phone" class="hidden">Telepon</label>
            <input type="tel" id="phone" placeholder="Nomor Telepon" required pattern="[0-9]+"
                inputmode="numeric"
                class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                wire:model.defer="phone">
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:w-full">
            <label for="comment" class="hidden">Komentar</label>
            <textarea id="comment" rows="8" placeholder="Tulis Pesan" required
                class="w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('message') border-red-500 @enderror"
                wire:model.defer="message"></textarea>
            @error('message')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        @if ($this->isBotProtectionEnabled())
            <div class="w-full flex justify-center mt-4">
                @if ($this->getBotProtectionType() === 'captcha')
                    <div wire:ignore>
                        {!! NoCaptcha::display() !!}
                    </div>
                @elseif ($this->getBotProtectionType() === 'turnstile')
                    <div wire:ignore>
                        <x-turnstile wire:model.defer="turnstile" />
                    </div>
                @endif
            </div>
            
            @error('captcha')
                <span class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
            @enderror
            @error('turnstile')
                <span class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
            @enderror
        @endif

        @error('form')
            <span class="text-red-500 text-sm w-full text-center">{{ $message }}</span>
        @enderror

        <!--Button-->
        <div class="w-full flex justify-center">
            <button type="submit" 
                class="w-fit btn1 mt-5 flex items-center gap-2 text-white"
                wire:loading.attr="disabled" 
                wire:target="submit"
                id="submit-button"
                @if($formSubmitted) disabled @endif>
                <span wire:loading.remove wire:target="submit">
                    @if($formSubmitted)
                        Terkirim - Refresh halaman untuk mengirim lagi
                    @else
                        Kirim
                    @endif
                </span>
                <span wire:loading wire:target="submit">Mengirim...</span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </button>
        </div>
    </form>

    {{-- JavaScript sections --}}
    @if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'captcha')
        <script>
            document.addEventListener('livewire:init', function() {
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

            document.addEventListener('livewire:init', function() {
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
            document.addEventListener('DOMContentLoaded', function() {
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
            document.addEventListener('livewire:init', function() {
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
            document.addEventListener('DOMContentLoaded', function() {
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
        document.addEventListener('livewire:init', function() {
            Livewire.on('hide-success-after-delay', () => {
                setTimeout(() => {
                    @this.call('hideSuccess');
                }, 5000);
            });
        });
    </script>
</div>