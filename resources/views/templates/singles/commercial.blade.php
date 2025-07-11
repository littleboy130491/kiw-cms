@pushOnce('before_body_close')
    @vite('resources/js/pages/single-building.js')
@endPushOnce
<x-layouts.app :title="$item->title ?? 'Default Page'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/bangunan-pabrik-hero.jpg')" h1="Area Komersil" />
        @if (Str::doesntContain($item->content, ['Coming soon', 'coming soon']))
            <section id="bangunan-pabrik"
                class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-18 lg:gap-20 lg:w-[1200px] lg:mx-auto">

                <!--Title-->
                <div class="flex flex-col lg:flex-row lg:items-start gap-7 lg:gap-9">
                    <h2 class="get-message" data-aos="fade-up" class="lg:w-1/3">
                        {{ $item->title }}
                    </h2>

                    <div class="lg:w-2/3 flex flex-col gap-5">
                        <p>
                            {!! $item->content !!}
                        </p>
                        @if ($item->whatsapp)
                            <!--button-->
                            <a class="w-fit btn1 mt-5 wa-message"data-aos="fade-down" href="{{ $item->whatsapp }}"
                                target="_blank">hubungi
                                sekarang
                                <span>
                                    <img src="{{ Storage::url('media/whatsapp-white.png') }}">
                                </span>
                            </a>
                        @endif
                    </div>

                </div>

                <!--Content-->
                <x-loop.gallery-grid :gallery="$item->gallery" />

            </section>
            <!--Start Spesifikasi-->
            @if ($item->specification)
                <section id="spesifikasi" class="lg:py-30 py-18 bg-cover bg-[var(--color-transit)]">
                    <div
                        class="flex flex-col lg:flex-row lg:gap-8 gap-5 lg:px-0 lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">

                        <!--Heading-->
                        <h2 data-aos="fade-up" class="lg:w-1/3">Spesifikasi</h2>

                        <!--Content-->
                        <div class="lg:w-2/3 flex flex-col">
                            @foreach ($item->specification as $spec)
                                <x-loop.spesifikasi :label="$spec['name']" :value="$spec['value']" />
                            @endforeach
                        </div>

                    </div>
                </section>
            @endif

            <!--End Spesifikasi-->
        @else
            <x-partials.area-komersil-coming-soon :title="$item->title" :image="$item->gallery[0]" />
        @endif
    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
