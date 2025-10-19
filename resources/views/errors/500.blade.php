<x-layouts.app title="{{ __('error.500.title') }}">
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="Storage::url('media/bangunan-pabrik-hero.jpg')"
            h1="{{ __('error.500.hero_title') }}" />

        <section id="500-page" class="my-18 lg:my-30 mx-4 sm:mx-6 lg:mx-0 text-center flex flex-col items-center gap-5">
            <h6 data-aos="fade-down" class="bullet-1">{{ __('error.500.error_code') }}</h6>
            <h2 data-aos="fade-top" class="font-bold">{{ __('error.500.main_message') }}</h2>
            <div class="flex flex-col gap-5">
                <p class="sub-p">{{ __('error.500.description_1') }}</p>
                <p>{{ __('error.500.description_2') }}</p>
            </div>
            <a class="w-fit btn1 back mt-5" data-aos="fade-down" href="/">
                {{ __('common.back_to_home') }}
                <span><x-icon.arrow-back-white /></span>
            </a>
        </section>
    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>