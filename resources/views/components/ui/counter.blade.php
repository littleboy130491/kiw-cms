@props([
    'number' => 0,
    'suffix' => '',
    'prefix' => '',
    'title' => '',
    'description' => '',
    'variant' => 'default', // 'default', 'hero', 'minimal', 'card'
    'size' => 'default', // 'sm', 'default', 'lg', 'xl'
    'textAlign' => 'center', // 'left', 'center', 'right'
    'class' => '',
    'animationDuration' => 2000,
])

@php
    $variantClasses = [
        'default' => 'text-gray-900',
        'hero' => 'text-white',
        'minimal' => 'text-gray-600',
        'card' => 'bg-white p-6 rounded-lg shadow-md text-gray-900',
    ];

    $sizeClasses = [
        'sm' => [
            'number' => 'text-3xl font-bold',
            'title' => 'text-lg font-semibold',
            'description' => 'text-sm text-gray-600',
        ],
        'default' => [
            'number' => 'text-4xl lg:text-5xl font-bold',
            'title' => 'text-xl font-semibold',
            'description' => 'text-base text-gray-600',
        ],
        'lg' => [
            'number' => 'text-5xl lg:text-6xl font-bold',
            'title' => 'text-2xl font-semibold',
            'description' => 'text-lg text-gray-600',
        ],
        'xl' => [
            'number' => 'text-6xl lg:text-7xl font-bold',
            'title' => 'text-3xl font-semibold', 
            'description' => 'text-xl text-gray-600',
        ],
    ];

    $alignmentClasses = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];

    $currentSize = $sizeClasses[$size] ?? $sizeClasses['default'];
    
    $containerClasses = collect([
        $variantClasses[$variant] ?? $variantClasses['default'],
        $alignmentClasses[$textAlign] ?? 'text-center',
        $class,
    ])->filter()->implode(' ');
@endphp

<div 
    class="{{ $containerClasses }}"
    data-counter="{{ $number }}"
    data-duration="{{ $animationDuration }}"
    {{ $attributes->except(['class']) }}
>
    {{-- Counter Number --}}
    <div class="{{ $currentSize['number'] }} counter-number">
        @if($prefix)
            <span class="counter-prefix">{{ $prefix }}</span>
        @endif
        <span class="counter-value">0</span>
        @if($suffix)
            <span class="counter-suffix">{{ $suffix }}</span>
        @endif
    </div>
    
    {{-- Title --}}
    @if($title)
        <h3 class="{{ $currentSize['title'] }} mt-2">
            {{ $title }}
        </h3>
    @endif
    
    {{-- Description --}}
    @if($description)
        <p class="{{ $currentSize['description'] }} mt-1">
            {{ $description }}
        </p>
    @endif
    
    {{-- Additional Content --}}
    @if($slot->isNotEmpty())
        <div class="mt-4">
            {{ $slot }}
        </div>
    @endif
</div>