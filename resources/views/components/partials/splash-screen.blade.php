@props([
    'setOnce' => true
])

<!--Opening Animation   -->
<div id="splash-screen">
    <div class="logo-sequence min-w-[100vw] min-h-[100vh] flex flex-col justify-center items-center bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ Storage::url('media/background-splash.jpg') }}');">
        <div class="absolute inset-0 bg-white opacity-90 !z-[99999999999999999999999991]"></div>

        <img id="logo-image" class="relative !z-[99999999999999999999999992] min-h-18 max-h-18  object-contain"
            src="{{ Storage::url('media/kiw-old.png') }}" alt="Logo">
        <div id="year-text"
            class="custom-shadow !z-[99999999999999999999999993] lg:text-[25em] sm:text-[20em] text-[10em] lg:py-0 py-4 font-bold text-transparent bg-cover bg-center bg-no-repeat bg-clip-text bg-fixed pointer-events-none lg:-mt-15 sm:-mt-25 -mt-16"
            style="background-image: url('{{ Storage::url('media/background-splash.jpg') }}');">
            1988
        </div>

    </div>
</div>

<div id="logo-sequence" class="hidden">
    <img class="logo-item" data-year="1998" src="{{ Storage::url('media/kiw.png') }}" alt="Logo tahun 1998">
    <img class="logo-item" data-year="2018" src="{{ Storage::url('media/pws-logo.png') }}" alt="Logo tahun 2018">
    <img class="logo-item" data-year="2020" src="{{ Storage::url('media/gbc-logo.png') }}" alt="Logo tahun 2020">
    <img class="logo-item" data-year="2022" src="{{ Storage::url('media/Danareksa.png') }}" alt="Logo tahun 2022">
    <img class="logo-item" data-year="2022" src="{{ Storage::url('media/Danareksa.png') }}" alt="Logo tahun 2022">
    <img class="logo-item" data-year="2024" src="{{ Storage::url('media/Danareksa.png') }}" alt="Logo tahun 2024">

</div>