@props([
    'variant' => 'default', // 'default', 'bordered', 'shadow', 'elevated'
    'padding' => 'default', // 'none', 'sm', 'default', 'lg'
    'rounded' => 'default', // 'none', 'sm', 'default', 'lg', 'xl'
    'href' => null,
    'target' => null,
    'class' => '',
])

@php
    $variantClasses = [
        'default' => 'bg-white',
        'bordered' => 'bg-white border border-gray-200',
        'shadow' => 'bg-white shadow-md',
        'elevated' => 'bg-white shadow-lg hover:shadow-xl transition-shadow duration-300',
    ];

    $paddingClasses = [
        'none' => '',
        'sm' => 'p-4',
        'default' => 'p-6',
        'lg' => 'p-8',
    ];

    $roundedClasses = [
        'none' => '',
        'sm' => 'rounded-sm',
        'default' => 'rounded-lg',
        'lg' => 'rounded-xl',
        'xl' => 'rounded-2xl',
    ];

    $cardClasses = collect([
        'relative',
        $variantClasses[$variant] ?? $variantClasses['default'],
        $paddingClasses[$padding] ?? $paddingClasses['default'],
        $roundedClasses[$rounded] ?? $roundedClasses['default'],
        $href ? 'hover:scale-105 transition-transform duration-300 cursor-pointer' : '',
        $class,
    ])->filter()->implode(' ');

    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if($href)
        href="{{ $href }}"
        @if($target) target="{{ $target }}" @endif
    @endif
    {{ $attributes->merge(['class' => $cardClasses]) }}
>
    {{ $slot }}
</{{ $tag }}>