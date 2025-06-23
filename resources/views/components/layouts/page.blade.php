@props([
    'title' => null,
    'description' => null,
    'bodyClasses' => '',
    'showHeader' => true,
    'showFooter' => true,
    'showWhatsapp' => true,
    'containerClass' => 'max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8',
])

<x-layouts.base 
    :title="$title" 
    :description="$description" 
    :body-classes="$bodyClasses"
>
    @if($showHeader)
        <x-partials.header />
    @endif
    
    <main role="main" class="min-h-screen">
        {{ $slot }}
    </main>
    
    @if($showFooter)
        <x-partials.footer />
    @endif
    
    @if($showWhatsapp)
        <x-partials.whatsapp />
    @endif
    
    {{-- Common page-level assets --}}
    @push('head')
        {{-- AOS Animation --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @endpush
    
    @push('scripts')
        {{-- AOS Animation --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
        {{-- Alpine.js --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
</x-layouts.base>