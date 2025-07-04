@props([
    'image' => 'media/content-default.jpg',
    'top' => '0',
    'left' => '0',
    'label' => '',
    'luas' => '',
    'slot' => '',
])


<div class="item-for-popup absolute transform -translate-y-1/2" style="top: {{ $top ?? '0' }}%; left: {{ $left ?? '0' }}%" onclick="openModal(this)">
    
    <!-- Lingkaran animasi di belakang ikon -->
    <span class="absolute inset-0 rounded-full animate-ping pointer-events-none"></span>
    
    <!-- Ikon lokasi -->
    <i class="fa-solid fa-location-dot text-blue-600 text-[16px] z-10 relative cursor-pointer animate-top-down"></i>
    <!-- Hidden Info -->
    <div class="hidden">
        <h6 class="position">Luas Tanah: {{ $luas }}</h6>
        <h4 class="name">{{ $label }}</h4>
        <img class="photo" src="{{ asset($image) }}">
    </div>

    <div class="description hidden">
        {{ $slot }}
    </div>
</div>




