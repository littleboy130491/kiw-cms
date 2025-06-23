{{-- 
    Refactored Home Template
    This is a clean, maintainable version of the original 745-line home.blade.php
    Breaking it down into reusable components for better organization
--}}

<x-layouts.home :title="$title ?? 'Home'" :body-classes="$bodyClasses ?? ''">
    
    {{-- Splash Screen Animation --}}
    <x-home.splash-screen />
    
    {{-- Header KIW --}}
    <x-header-kiw />
    
    {{-- Home Popup --}}
    <x-partials.popup-home />
    
    {{-- Hero Banner Section --}}
    <x-home.hero-banner :slides="[
        [
            'video' => 'https://www.youtube.com/embed/1t_z7FMcsOw?autoplay=1&loop=1&mute=1&controls=0&playlist=1t_z7FMcsOw&modestbranding=1&showinfo=0',
            'fallback_image' => asset('storage/media/background-home.jpg'),
            'title' => 'Kawasan Industri Strategis untuk Pertumbuhan Bisnis',
            'description' => 'Fasilitas lengkap, aksesibilitas tinggi, dan dukungan profesional bagi investor.',
            'buttons' => [
                [
                    'text' => 'Lihat Layanan',
                    'href' => '/#layanan-home',
                    'variant' => 'outline',
                    'size' => 'lg'
                ]
            ],
            'bottom_content' => view('components.home.partials.hero-counters')->render()
        ],
        [
            'image' => asset('storage/media/hero-home-2.jpg'),
            'title' => 'Dukungan Infrastruktur Lengkap untuk Kesuksesan Bisnis Anda',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.magna aliqua.',
            'buttons' => [
                [
                    'text' => 'Lihat Layanan',
                    'href' => '/#layanan-home',
                    'variant' => 'outline',
                    'size' => 'lg'
                ]
            ]
        ]
    ]" />
    
    {{-- About Section --}}
    <x-home.about-section 
        :counters="[
            ['number' => '36', 'title' => 'Tahun Pengalaman'],
            ['number' => '100', 'title' => 'Perusahaan Tenant'],
            ['number' => '5000', 'title' => 'Tenaga Kerja']
        ]"
        buttonText="Baca Selengkapnya"
        buttonHref="/tentang-kami"
    />
    
    {{-- Services Section --}}
    {{-- TODO: Create services section component --}}
    <section id="layanan-home">
        {{-- Existing services content will be componentized --}}
    </section>
    
    {{-- Advantages Section --}}
    {{-- TODO: Create advantages section component --}}
    <section id="keunggulan-home">
        {{-- Existing advantages content will be componentized --}}
    </section>
    
    {{-- Industry Tabs Section --}}
    {{-- TODO: Create industry tabs component --}}
    <section id="industry-tabs">
        {{-- Existing industry tabs content will be componentized --}}
    </section>
    
    {{-- Facilities Section --}}
    {{-- TODO: Create facilities section component --}}
    <section id="fasilitas-home">
        {{-- Existing facilities content will be componentized --}}
    </section>
    
    {{-- Video Section --}}
    {{-- TODO: Create video section component --}}
    <section id="video-section">
        {{-- Existing video content will be componentized --}}
    </section>
    
    {{-- Tenant Section --}}
    {{-- TODO: Create tenant section component --}}
    <section id="tenant-section">
        {{-- Existing tenant content will be componentized --}}
    </section>
    
    {{-- News Section --}}
    {{-- TODO: Create news section component --}}
    <section id="berita-home">
        {{-- Existing news content will be componentized --}}
    </section>
    
    {{-- Instagram Feed --}}
    <x-ui.behold-ig-feed />
    
</x-layouts.home>