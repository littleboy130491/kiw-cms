@props([
    'variant' => 'primary', // 'primary', 'secondary', 'outline', 'ghost', 'link'
    'size' => 'default', // 'sm', 'default', 'lg', 'xl'
    'href' => null,
    'type' => 'button',
    'target' => null,
    'disabled' => false,
    'loading' => false,
    'icon' => null,
    'iconPosition' => 'left', // 'left', 'right'
    'class' => '',
])

@php
    $variantClasses = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
        'outline' => 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:ring-blue-500',
        'ghost' => 'text-gray-700 hover:bg-gray-100 focus:ring-gray-500',
        'link' => 'text-blue-600 hover:text-blue-800 underline focus:ring-blue-500',
    ];

    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-sm',
        'default' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
        'xl' => 'px-8 py-4 text-xl',
    ];

    $baseClasses = 'inline-flex items-center justify-center font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $roundedClasses = $variant === 'link' ? '' : 'rounded-md';
    
    $buttonClasses = collect([
        $baseClasses,
        $roundedClasses,
        $variantClasses[$variant] ?? $variantClasses['primary'],
        $sizeClasses[$size] ?? $sizeClasses['default'],
        $class,
    ])->filter()->implode(' ');

    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
    @if($href)
        href="{{ $href }}"
        @if($target) target="{{ $target }}" @endif
    @else
        type="{{ $type }}"
        @if($disabled) disabled @endif
    @endif
    {{ $attributes->merge(['class' => $buttonClasses]) }}
>
    {{-- Loading Spinner --}}
    @if($loading)
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif
    
    {{-- Left Icon --}}
    @if($icon && $iconPosition === 'left' && !$loading)
        <span class="mr-2">
            {!! $icon !!}
        </span>
    @endif
    
    {{-- Button Text --}}
    <span>{{ $slot }}</span>
    
    {{-- Right Icon --}}
    @if($icon && $iconPosition === 'right' && !$loading)
        <span class="ml-2">
            {!! $icon !!}
        </span>
    @endif
</{{ $tag }}>