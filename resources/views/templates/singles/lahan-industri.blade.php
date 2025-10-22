@php
    $blocks = collect($item->block);

    $imageSections = $blocks
        ->where('data.block_id', 'image')
        ->pluck('data')
        ->values();
    dd($imageSections);
    $hotspots = $blocks
        ->where('data.block_id', 'hotspot')
        ->pluck('data')
        ->values();

@endphp
<x-layouts.app>
    <x-partials.header />

    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/lahan-industri-hero.jpg')"
            h1="{{ $item->title }}" />

        <!--Start Lahan Industri-->

        <section data-aos="zoom-in-up" id="lahan-industri"
            class="relative map-container my-18 lg:my-30 relative px-4 sm:px-6 lg:px-0 overflow-x-auto whitespace-nowrap max-w-full lg:w-[1200px] lg:mx-auto">
            <div class="relative inline-block min-w-full">
                <img src="{{ $imageSections[0]['image_url'] }}" class="w-full">
                <!-- Hotspot Items -->
                @foreach ($hotspots as $item)
                    <x-loop.hotspot-item-lahan-industri :top="$item['top']" :left="$item['left']" :label="$item['title']"
                        :luas="$item['luas']" :image="$item['image_url']" :note="$item['note']">
                        {!! $item['description'] !!}
                    </x-loop.hotspot-item-lahan-industri>
                @endforeach
            </div>
            </div>
        </section>

        <!--Popup Content-->
        <div id="modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="modal-overlay absolute inset-0 bg-black opacity-75"></div>

            <div
                class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
                <!-- Modal Header -->
                <div class="modal-header flex flex-row justify-end pr-2 pt-2">

                    <button class="modal-close cursor-pointer" onclick="closeModal()">
                        <svg class="fill-current text-black h-6 w-6" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="modal-content pb-6 px-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="modal-image w-full md:w-1/3">
                            <img class="w-full rounded-md" src="">
                        </div>
                        <div class="modal-info w-full md:w-2/3 flex flex-col gap-7">
                            <div class="flex flex-col gap-2">
                                <h3 class="modal-title "></h3>
                                <p class="mb-4">{{__('lahan-industri.available')}}</p>
                                <h6 class="modal-position text-[var(--color-purple)] sm:mb-3"></h6>
                                <div
                                    class="modal-description text-[var(--color-text)] pr-2 overflow-y-auto sm:max-h-[300px] max-h-[150px]">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <p class="modal-note text-[#DD2F2F] italic">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Lahan Industri-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>