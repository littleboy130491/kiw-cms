@if ($shouldShow)
    <!--Opening Animation   -->
    <div id="splash-screen">
        <div class="logo-sequence min-w-[100vw] min-h-[100vh] flex flex-col justify-center items-center bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ Storage::url($backgroundImage) }}');">
            <div class="absolute inset-0 bg-white opacity-90 !z-[99999999999999999999999991]"></div>

            <img id="logo-image" class="relative !z-[99999999999999999999999992] min-h-18 max-h-18 object-contain"
                src="{{ Storage::url($logoImage) }}" alt="Logo">
            <div id="year-text"
                class="custom-shadow !z-[99999999999999999999999993] lg:text-[25em] sm:text-[20em] text-[10em] lg:py-0 py-4 font-bold text-transparent bg-cover bg-center bg-no-repeat bg-clip-text bg-fixed pointer-events-none lg:-mt-15 sm:-mt-25 -mt-16"
                style="background-image: url('{{ Storage::url($backgroundImage) }}');">
                {{ $year }}
            </div>
        </div>
    </div>

    <div id="logo-sequence" class="hidden">
        @foreach ($logoSequence as $logo)
            <img class="logo-item" data-year="{{ $logo['year'] }}" src="{{ Storage::url($logo['src']) }}"
                alt="{{ $logo['alt'] }}">
        @endforeach
    </div>

@endif
