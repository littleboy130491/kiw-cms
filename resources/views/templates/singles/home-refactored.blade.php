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
    <x-home.services-section />
    
    {{-- Advantages Section --}}
    <x-home.advantages-section />
    
    {{-- Industry Tabs Section --}}
    <x-home.industry-tabs />
    
    {{-- Facilities Section --}}
    <x-home.facilities-section />
    
    {{-- Video Section --}}
    <x-home.video-section 
        videoId="dQw4w9WgXcQ"
        :thumbnailImage="asset('storage/media/back-video.jpg')"
        title="Kawasan Industri Wijayakusuma"
        description="Tonton video profil lengkap tentang fasilitas dan layanan yang kami tawarkan"
    />
    
    {{-- Tenant Section --}}
    <x-home.tenant-section />
    
    {{-- News Section --}}
    <x-home.news-section :posts="$posts ?? collect()" />
    
    {{-- Instagram Feed --}}
    <x-ui.behold-ig-feed />
    
</x-layouts.home>