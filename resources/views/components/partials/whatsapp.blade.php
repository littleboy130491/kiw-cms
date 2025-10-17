@php
    $waNumber = app('settings')->whatsapp_1 ?? config('cms.site_social_media.whatsapp');
@endphp

<div id="wa-widget" 
     x-data="waWidget('{{ preg_replace('/[^0-9]/', '', $waNumber) }}')" 
     class="fixed bottom-6 right-6 z-999 flex flex-col items-end">
    
    <!-- Chat Box -->
    <div x-show="open" x-transition @click.away="open = false"
         class="w-75 sm:w-90 shadow-lg rounded-xl overflow-hidden mb-3 bg-cover bg-center"
         style="background-image:url('{{ Storage::url('media/wa-background.jpg') }}')">

        <!-- Header -->
        <div class="bg-[#128C7E] text-white px-4 py-3 flex justify-between items-center">
            <div class="flex flex-row items-center gap-2">
                <svg class="w-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4..."></path>
                </svg>
                <h4 class="text-white text-[1.2em]">Customer Service KIW</h4>
            </div>
            <button @click="open = false" class="text-white text-[2em] cursor-pointer">&times;</button>
        </div>

        <!-- Bubble -->
        <div class="p-4 bg-white space-y-2 m-6 rounded-md bubble-wa relative">
            <p class="text-[--color-heading] z-50 relative">
                Halo! 👋 Selamat datang di website resmi <b>PT Kawasan Industri Wijayakusuma (KIW)</b>.<br><br>
                Kami siap membantu Anda menemukan solusi kawasan industri terbaik di Indonesia.<br><br>
                Silakan chat langsung untuk mengetahui lebih lanjut mengenai lahan industri,
                Bangunan Pabrik Siap Pakai (BPSP), atau fasilitas layanan terpadu kami.
            </p>
            <img class="absolute top-0 -left-3 w-12 z-10" src="{{ Storage::url('media/wa-bubble-caret.png') }}">
            <div class="flex flex-row justify-end gap-2 mt-3">
                <p class="text-[.8em]">{{ now()->setTimezone('Asia/Jakarta')->format('H:i') }}</p>
            </div>
        </div>

        <!-- Input -->
        <div class="px-6 pb-3">
            <form @submit.prevent="kirimWA" class="flex flex-row gap-2">
                <input id="waInput" 
                       type="search" 
                       placeholder="Ketik pesan"
                       class="w-full bg-white px-4 py-2 border rounded-full border-[var(--color-border)] 
                              focus:outline-none focus:ring-2 focus:ring-[var(--color-blue)]" />
                <button type="submit" 
                        class="w-13 h-10 bg-cover bg-center bg-no-repeat rounded-full cursor-pointer"
                        style="background-image:url('{{ Storage::url('media/wa-btn.png') }}')"></button>
            </form>
        </div>
    </div>

    <!-- Floating Button -->
    <button @click="open = !open"
        class="w-14 h-14 rounded-full bg-green-500 text-white text-2xl flex items-center justify-center shadow-lg hover:bg-green-600 transition duration-200 cursor-pointer">
        <svg class="w-8 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M380.9 97.1C339 55.1..."></path>
        </svg>
    </button>
</div>

@pushOnce('before_body_close')
<script>
function waWidget(phone) {
    return {
        open: false,
        phone: phone,
        kirimWA() {
            const input = document.getElementById('waInput');
            const text = input.value.trim();
            if (!text) {
                alert('Silakan ketik pesan terlebih dahulu.');
                return;
            }

            // Encode pesan agar URL valid
            const message = encodeURIComponent(text);

            // Gunakan api.whatsapp.com (lebih stabil lintas platform)
            const url = `https://api.whatsapp.com/send?phone=${this.phone}&text=${message}`;

            // Buka di tab baru
            window.open(url, '_blank');
        }
    }
}
</script>
@endPushOnce
