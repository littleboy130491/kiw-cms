@pushOnce('before_head_close')
    @turnstileScripts()
@endpushOnce
<div>
    @if ($showSuccess)
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ __('sumimasen-cms::submission-form.success_message') }}
        </div>
    @endif

    <div class="py-18 lg:py-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-9 lg:w-[1200px] lg:mx-auto">
        <!--title-->
        <div class="flex flex-col gap-5">
            <h2 data-aos="fade-up" class="text-center">Mari Bergabung dengan KIW?</h2>
            <p class="text-center">Gabung sekarang dan temukan berbagai kemudahan serta peluang bisnis strategis bersama
                KIW.</p>
        </div>
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

            @if ($isBotProtectionEnabled)
                <div class="w-full flex justify-center mt-4">
                    @if ($botProtectionType === 'captcha')
                        <div wire:ignore>
                            {!! NoCaptcha::display() !!}
                        </div>
                        @error('captcha')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    @elseif ($botProtectionType === 'turnstile')
                        <x-turnstile wire:model="turnstile" />
                        @error('turnstile')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    @endif
                </div>
            @endif

            @error('form')
                <span class="text-red-500 text-sm w-full text-center">{{ $message }}</span>
            @enderror

            <!--Button-->
            <button type="submit" class="w-fit btn1 mt-5 flex items-center gap-2 text-white self-center"
                data-aos="fade-down" wire:loading.attr="disabled" wire:target="submit">
                <span wire:loading.remove wire:target="submit">Kirim</span>
                <span wire:loading wire:target="submit">Mengirim...</span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            </button>
        </form>
    </div>

    @if ($isBotProtectionEnabled && $botProtectionType === 'captcha')
        <script>
            document.addEventListener('livewire:load', function() {
                window.livewire.on('reset-captcha', () => {
                    grecaptcha.reset();
                });
            });
        </script>
    @endif

    @if ($isBotProtectionEnabled && $botProtectionType === 'turnstile')
        <script>
            document.addEventListener('livewire:load', function() {
                window.livewire.on('reset-turnstile', () => {
                    turnstile.reset();
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('hide-success-after-delay', () => {
                setTimeout(() => {
                    @this.call('hideSuccess');
                }, 5000);
            });
        });
    </script>
</div>
