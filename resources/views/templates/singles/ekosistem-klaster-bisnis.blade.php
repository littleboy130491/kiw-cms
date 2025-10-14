@php
    $tabSektorIndustri = [];
    
    if (isset($item->block) && is_array($item->block)) {
        foreach ($item->block as $block) {
            if ($block['data']['block_id'] === 'tab') {
                $data = $block['data'];
                $tabSektorIndustri[] = [
                    'tabTitle' => $data['title'] ?? '',
                    'tabContent' => [
                        'title' => $data['subtitle'] ?? '',
                        'description' => $data['description'] ?? '',
                        'image' => $data['media_url'] ?? '',
                    ]
                ];
            }
        }
    }

@endphp

<x-layouts.app>
    <x-partials.header />

    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/bdc43b57-5e80-418a-9a89-47cf20e59746.jpg')" h1="{{ $item->title ?? 'Ekosistem Klaster Bisnis' }}" />


    <!--Start Tab Sektor Industri-->
    <section id="tab" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto relative">
        <div x-data="{ tab: 'tab1' }" class="rounded-md">
            <!-- Tab Headers -->
            <div
                class="header-sektor-wrap lg:flex lg:flex-row lg:justify-start lg:gap-5 grid grid-cols-2 gap-2 justify-center z-1">
                @foreach ($tabSektorIndustri as $index => $item)
                <x-tab.tab-headers-sektor
                    :title="$item['tabTitle']"
                    :tab="'tab' . ($index + 1)"
                />
                @endforeach
            </div>

            <!-- Tab Contents -->
            @foreach ($tabSektorIndustri as $index => $item)
            <x-tab.tab-contents-sektor id="tab{{ $index + 1 }}" :title="$item['tabContent']['title']"
                :image="$item['tabContent']['image']" :desc="$item['tabContent']['description']" />
            @endforeach
        </div>
    </section>

    <!--End Sektor Industri-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
