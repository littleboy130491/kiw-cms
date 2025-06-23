@props([
    'src' => '',
    'alt' => '',
    'width' => null,
    'height' => null,
    'sizes' => '100vw',
    'loading' => 'lazy',
    'class' => '',
    'aspectRatio' => null, // '16/9', '4/3', '1/1', etc.
    'objectFit' => 'cover', // 'cover', 'contain', 'fill'
    'placeholder' => null,
    'fallback' => null,
])

@php
    $aspectRatioClasses = [
        '16/9' => 'aspect-video',
        '4/3' => 'aspect-4/3',
        '1/1' => 'aspect-square',
        '3/2' => 'aspect-3/2',
        '2/3' => 'aspect-2/3',
    ];

    $objectFitClasses = [
        'cover' => 'object-cover',
        'contain' => 'object-contain',
        'fill' => 'object-fill',
        'none' => 'object-none',
        'scale-down' => 'object-scale-down',
    ];

    $imageClasses = collect([
        'w-full h-full',
        $objectFitClasses[$objectFit] ?? 'object-cover',
        $class,
    ])->filter()->implode(' ');

    $containerClasses = collect([
        'relative overflow-hidden',
        $aspectRatio ? ($aspectRatioClasses[$aspectRatio] ?? '') : '',
    ])->filter()->implode(' ');
@endphp

<div class="{{ $containerClasses }}">
    @if($placeholder)
        {{-- Placeholder/Loading state --}}
        <div class="absolute inset-0 bg-gray-200 animate-pulse flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
            </svg>
        </div>
    @endif
    
    <img 
        src="{{ $src }}"
        alt="{{ $alt }}"
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        sizes="{{ $sizes }}"
        loading="{{ $loading }}"
        class="{{ $imageClasses }}"
        @if($fallback)
            onerror="this.src='{{ $fallback }}'"
        @endif
        {{ $attributes->except(['class']) }}
    >
</div>