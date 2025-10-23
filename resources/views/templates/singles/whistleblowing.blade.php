@php
    // Extract data from CMS blocks
    $section1Block = collect($item->block)->firstWhere('data.block_id', 'section-1');
    $section2Block = collect($item->block)->firstWhere('data.block_id', 'section-2');
    $formulirPengaduanBlock = collect($item->block)->firstWhere('data.block_id', 'formulir-pengaduan');

    $whistleblowingBlock = [
        'title' => $section1Block['data']['title'] ?? 'Whistleblowing',
        'descTop' => $section1Block['data']['description'] ?? '',
        'image' => $section1Block['data']['image_url'] ?? Storage::url('media/gratifikasi.jpg'),
        'descBottom' => $section2Block['data']['description'] ?? ''
    ];

    $formBlock = [
        'title' => $formulirPengaduanBlock['data']['title'],
        'desc' => $formulirPengaduanBlock['data']['description'],
    ];
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/whistleblowing-hero.jpg')"
            h1="{{ $item->title ?? 'Whistleblowing' }}" />

        <!--Start Post Content-->

        <section id="whistleblowing-content"
            class="flex flex-col lg:flex-row gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

            <!--Main Content-->
            <div class="flex flex-col gap-7 lg:gap-9">
                <!--Title-->
                <h2 data-aos="fade-up">
                    {{  $whistleblowingBlock['title'] }}
                </h2>

                <!--Content-->
                <div class="flex flex-col gap-5">
                    {!! $whistleblowingBlock['descTop'] !!}
                    <!--Image-->
                    <div class="relative">
                        <a class="gallery-item" href="{{ $whistleblowingBlock['image'] }}" data-lightbox="gallery">
                            <img class="rounded-md" src="{{ $whistleblowingBlock['image'] }}" loading="lazy"/>
                        </a>
                    </div>
                    {!! $whistleblowingBlock['descBottom'] !!}

                </div>
            </div>

        </section>

        <!--End Post Content-->

        <!-- Start Form -->
        <section id="whistleblowing-form" class="bg-[var(--color-transit])">

            <!--Start Form-->
            <div
                class="py-18 lg:pt-0 lg:pb-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-9 lg:w-[1200px] lg:mx-auto">
                <!--title-->
                <div class="flex flex-col gap-5">
                    <h2 data-aos="fade-up" class="text-center">{!! $formBlock['title'] !!}</h2>
                    <p class="text-center">{!! $formBlock['desc'] !!}</p>
                </div>
                <!--form-->
                <livewire:whistleblowing-form />
            </div>

        </section>
        <!--End Form-->





    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>