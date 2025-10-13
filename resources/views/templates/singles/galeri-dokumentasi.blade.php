<x-layouts.app>
    <x-partials.header />
    <main>
       <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/galeri-dokumentasi-hero.jpg')" h1="{{$item->title ?? 'Galeri Dokumentasi'}}" />

        <!--Start Foto-->

        <section id="photo-gallery"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-7 lg:gap-10 lg:w-[1200px] lg:mx-auto">

            <!--Title-->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <h2 data-aos="fade-up">
                {{ __('galeri-dokumentasi.media_sosial') }}
                </h2>

                <!--button-->
                <a class="w-fit btn1" data-aos="fade-down"
                    href="{{ app('settings')->instagram ?? config('cms.site_social_media.instagram') }}" target="_blank"
                    rel="noopener noreferrer">kunjungi instagram
                    <x-icon.instagram-icon-white />
                </a>

            </div>

            <!--Content-->
            <x-instagram-behold/>


        </section>

        <!--End Foto -->

        <!--Start Video-->

        <section id="video-gallery" class="py-18 lg:py-30 bg-[var(--color-transit)]">
            <div x-data="{ tab: 'tab1' }" class="px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto gap-7">

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 ">

                    <h2 data-aos="fade-up">{{ __('galeri-dokumentasi.dokumentasi_video') }}</h2>

                    <!-- Tab Headers -->
                    <div class="flex flex-row gap-2 sm:gap-2 z-1" data-aos="fade-down">
                        <x-tab.tab-headers-video title="youtube" tab="tab1" />
                        <x-tab.tab-headers-video title="Reels instagram" tab="tab2" />
                    </div>
                </div>


                <!-- Tab Contents -->
                <x-tab.tab-contents-video id="tab1">
                    <x-sumimasen-cms::component-loader name="dokumentasi-video" />
                </x-tab.tab-contents-video>


                <x-tab.tab-contents-video id="tab2">
                    <x-instagram-feed type="video" :columns="4" limit="20" />
                </x-tab.tab-contents-video>

            </div>
        </section>

        <!--End Video-->

        <!--Start Kegiatan Perusahaan-->
        <section id="kegiatan-perusahaan-gallery"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-7 lg:gap-10 lg:w-[1200px] lg:mx-auto">
            <livewire:gallery-list />
           



        </section>
        <!--End Kegiatan Perusahaan-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
