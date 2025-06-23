@props([
    'title' => 'Home - ' . config('app.name'),
    'description' => null,
    'bodyClasses' => '',
])

<x-layouts.base 
    :title="$title" 
    :description="$description" 
    :body-classes="$bodyClasses"
>
    {{-- Home-specific head assets --}}
    @push('head')
        {{-- AOS Animation --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        {{-- Swiper CSS --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        
        {{-- Lightbox CSS --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
    @endpush
    
    {{-- Home-specific scripts --}}
    @push('scripts')
        {{-- AOS Animation --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
        {{-- Alpine.js --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        {{-- Swiper JS --}}
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        
        {{-- jQuery and Lightbox --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    @endpush
    
    {{-- Header --}}
    <x-partials.header />
    
    {{-- Main Content --}}
    <main role="main">
        {{ $slot }}
    </main>
    
    {{-- Footer --}}
    <x-partials.footer />
    
    {{-- WhatsApp Widget --}}
    <x-partials.whatsapp />
</x-layouts.base>