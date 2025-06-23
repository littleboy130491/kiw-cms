@props([
    'size' => 'default', // 'sm', 'default', 'lg', 'xl', 'full'
    'padding' => 'default', // 'none', 'sm', 'default', 'lg'
    'center' => true,
    'class' => '',
])

@php
    $sizeClasses = [
        'sm' => 'max-w-screen-sm',
        'default' => 'max-w-screen-xl',
        'lg' => 'max-w-7xl',
        'xl' => 'max-w-[1200px]',
        'full' => 'max-w-full',
    ];

    $paddingClasses = [
        'none' => '',
        'sm' => 'px-2 sm:px-4',
        'default' => 'px-4 sm:px-6 lg:px-8',
        'lg' => 'px-6 sm:px-8 lg:px-12',
    ];

    $containerClasses = collect([
        $sizeClasses[$size] ?? $sizeClasses['default'],
        $center ? 'mx-auto' : '',
        $paddingClasses[$padding] ?? $paddingClasses['default'],
        $class,
    ])->filter()->implode(' ');
@endphp

<div {{ $attributes->merge(['class' => $containerClasses]) }}>
    {{ $slot }}
</div>