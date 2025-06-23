@props([
    'variant' => 'default', // 'default', 'primary', 'secondary', 'dark', 'light'
    'padding' => 'default', // 'none', 'sm', 'default', 'lg', 'xl'
    'background' => null,
    'overlay' => false,
    'overlayOpacity' => '90',
    'containerSize' => 'xl',
    'class' => '',
])

@php
    $variantClasses = [
        'default' => 'bg-white text-gray-900',
        'primary' => 'bg-blue-600 text-white',
        'secondary' => 'bg-gray-100 text-gray-900',
        'dark' => 'bg-gray-900 text-white',
        'light' => 'bg-gray-50 text-gray-900',
    ];

    $paddingClasses = [
        'none' => '',
        'sm' => 'py-8 lg:py-12',
        'default' => 'py-12 lg:py-20',
        'lg' => 'py-16 lg:py-24',
        'xl' => 'py-20 lg:py-32',
    ];

    $sectionClasses = collect([
        'relative',
        $background ? 'bg-cover bg-center bg-no-repeat' : '',
        $variantClasses[$variant] ?? $variantClasses['default'],
        $paddingClasses[$padding] ?? $paddingClasses['default'],
        $class,
    ])->filter()->implode(' ');

    $backgroundStyle = $background ? "background-image: url('{$background}')" : '';
@endphp

<section 
    {{ $attributes->merge(['class' => $sectionClasses]) }}
    @if($background) style="{{ $backgroundStyle }}" @endif
>
    {{-- Background Overlay --}}
    @if($overlay && $background)
        <div class="absolute inset-0 bg-black opacity-{{ $overlayOpacity }}"></div>
    @endif
    
    {{-- Content Container --}}
    <div class="relative">
        <x-ui.container :size="$containerSize">
            {{ $slot }}
        </x-ui.container>
    </div>
</section>