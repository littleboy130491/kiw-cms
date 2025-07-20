@pushOnce('before_body_close')
    @vite('resources/js/pages/home.js')
@endPushOnce

@php
    $archive_post_url = route('cms.archive.content', [app()->getLocale(), 'posts']);
    
    // Get page blocks
    $blocks = $page->blocks ?? [];
    
    // Extract specific blocks by their block-id
    $heroBlock = collect($blocks)->where('block-id', 'hero-banner')->first();
    $heroCountersBlock = collect($blocks)->where('block-id', 'hero-counters')->first();
    $aboutBlock = collect($blocks)->where('block-id', 'about-section')->first();
    $aboutCountersBlock = collect($blocks)->where('block-id', 'about-counters')->first();
    $servicesBlock = collect($blocks)->where('block-id', 'services-section')->first();
    $advantagesBlock = collect($blocks)->where('block-id', 'advantages-section')->first();
    $industryTabsBlock = collect($blocks)->where('block-id', 'industry-tabs')->first();
    $facilityBlock = collect($blocks)->where('block-id', 'facility-section')->first();
    $videoBlock = collect($blocks)->where('block-id', 'video-section')->first();
    $tenantBlock = collect($blocks)->where('block-id', 'tenant-section')->first();
    $newsBlock = collect($blocks)->where('block-id', 'news-section')->first();
    $investorBlock = collect($blocks)->where('block-id', 'investor-section')->first();
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.splash-screen />
        <x-partials.popup-home />

        {{-- Hero Banner Block --}}
        @if($heroBlock)
            <x-blocks.slider :data="$heroBlock['data']" />
            {{-- Hero Counters Block (integrated into hero section) --}}
            @if($heroCountersBlock)
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Insert hero counters into the hero section
                        const heroCountersHtml = `{!! addslashes(view('components.blocks.counters', ['data' => $heroCountersBlock['data']])->render()) !!}`;
                        const heroSection = document.querySelector('#hero-banner .gradient-black-hero > div');
                        if (heroSection) {
                            heroSection.insertAdjacentHTML('beforeend', heroCountersHtml);
                        }
                    });
                </script>
            @endif
        @endif

        {{-- About Section Block --}}
        @if($aboutBlock)
            <x-blocks.content-with-media :data="$aboutBlock['data']" />
            {{-- About Counters Block (integrated into about section) --}}
            @if($aboutCountersBlock)
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Insert about counters into the about section placeholder
                        const aboutCountersHtml = `{!! addslashes(view('components.blocks.counters', ['data' => $aboutCountersBlock['data']])->render()) !!}`;
                        const placeholder = document.querySelector('#about-counters-placeholder');
                        if (placeholder) {
                            placeholder.innerHTML = aboutCountersHtml;
                        }
                    });
                </script>
            @endif
        @endif

        {{-- Services Section Block --}}
        @if($servicesBlock)
            <x-blocks.section-with-items :data="$servicesBlock['data']" />
        @endif

        {{-- Advantages Section Block --}}
        @if($advantagesBlock)
            <x-blocks.section-with-items :data="$advantagesBlock['data']" />
        @endif

        {{-- Industry Tabs Block --}}
        @if($industryTabsBlock)
            <x-blocks.tabbed-content :data="$industryTabsBlock['data']" />
        @endif

        {{-- Facility Section Block --}}
        @if($facilityBlock)
            <x-blocks.facility-section :data="$facilityBlock['data']" />
        @endif

        {{-- Video Section Block --}}
        @if($videoBlock)
            <x-blocks.video-embed :data="$videoBlock['data']" />
        @endif

        {{-- Tenant Section Block --}}
        @if($tenantBlock)
            <x-blocks.logo-grid :data="$tenantBlock['data']" />
        @endif

        {{-- News Section Block --}}
        @if($newsBlock)
            <x-blocks.news-section :data="$newsBlock['data']" />
        @endif

        {{-- Investor Section Block --}}
        @if($investorBlock)
            <x-blocks.investor-section :data="$investorBlock['data']" />
        @endif

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>