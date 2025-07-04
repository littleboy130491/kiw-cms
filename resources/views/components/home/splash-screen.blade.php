@props([
    'backgroundImage' => Storage::url('media/background-splash.jpg'),
    'logoImage' => Storage::url('media/kiw-old.png'),
    'yearText' => '1988',
    'logoSequence' => [
        ['year' => '1998', 'image' => Storage::url('media/kiw.png'), 'alt' => 'Logo tahun 1998'],
        ['year' => '2018', 'image' => Storage::url('media/pws-logo.png'), 'alt' => 'Logo tahun 2018'],
        ['year' => '2020', 'image' => Storage::url('media/gbc-logo.png'), 'alt' => 'Logo tahun 2020'],
        ['year' => '2022', 'image' => Storage::url('media/Danareksa.png'), 'alt' => 'Logo tahun 2022'],
        ['year' => '2024', 'image' => Storage::url('media/Danareksa.png'), 'alt' => 'Logo tahun 2024'],
    ],
])

{{-- Splash Screen Animation --}}
<div id="splash-screen" class="fixed inset-0 z-[99999] flex items-center justify-center">
    <div class="logo-sequence w-full h-full flex flex-col justify-center items-center bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ $backgroundImage }}')">
        {{-- Background Overlay --}}
        <div class="absolute inset-0 bg-white opacity-90"></div>

        {{-- Main Logo --}}
        <img id="logo-image" class="relative z-10 h-18 object-contain" src="{{ $logoImage }}" alt="Company Logo">

        {{-- Year Text --}}
        <div id="year-text"
            class="custom-shadow relative z-10 font-bold text-transparent bg-cover bg-center bg-no-repeat bg-clip-text bg-fixed pointer-events-none lg:text-[25em] sm:text-[20em] text-[10em] lg:py-0 py-4 lg:-mt-15 sm:-mt-25 -mt-16"
            style="background-image: url('{{ $backgroundImage }}')">
            {{ $yearText }}
        </div>
    </div>
</div>

{{-- Hidden Logo Sequence --}}
<div id="logo-sequence" class="hidden">
    @foreach ($logoSequence as $logo)
        <img class="logo-item" data-year="{{ $logo['year'] }}" src="{{ $logo['image'] }}" alt="{{ $logo['alt'] }}">
    @endforeach
</div>
