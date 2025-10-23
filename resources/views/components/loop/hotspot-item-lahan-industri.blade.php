<div class="item-for-popup absolute transform -translate-y-1/2"
    style="top: {{ $top ?? '0' }}%; left: {{ $left ?? '0' }}%" onclick="openModal(this)">

    <!-- Lingkaran animasi di belakang ikon -->
    <span class="absolute inset-0 rounded-full animate-ping pointer-events-none"></span>

    <!-- Ikon lokasi -->
    <i class="fa-solid fa-location-dot text-red-600 text-[30px] z-10 relative cursor-pointer animate-top-down"></i>
    <!-- Hidden Info -->
    <div class="hidden">
        <h6 class="position">{{ __('lahan-industri.luas_tanah') }} {{ $luas }}</h6>
        <h4 class="name">{{ $label }}</h4>
        <img class="photo" src="{{ asset($image) }}" loading="lazy" />
    </div>

    <div class="description hidden">
        {{ $slot }}
    </div>
    <div class="note hidden">
        {!! $note !!}
    </div>

</div>