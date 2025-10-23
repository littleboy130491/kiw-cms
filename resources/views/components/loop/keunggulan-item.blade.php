@php
    $image = (int) $image; 
@endphp
<div id="{{ $id ?? '' }}">
    <div
        class="flex flex-col sm:flex-row gap-5 sm:gap-8 lg:gap-8 py-18 lg:py-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto">
        <div class="flex flex-col gap-5 sm:1/2 sm:py-5">
            @if ($h2)
                <h2 data-aos="fade-up">{{ $h2 }}</h2>
            @endif
            @if ($p)
                <p>
                    {{ $p }}
                </p>
            @endif
        </div>
        @if ($image)
            <x-curator-glider :media="$image" class="rounded-md sm:w-1/2 object-cover" loading="lazy"/>
        @endif
    </div>
</div>