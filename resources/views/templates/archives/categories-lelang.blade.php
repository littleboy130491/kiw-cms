<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$record->featuredImage->url ?? Storage::url('media/lelang-hero.jpg')"
            h1="{{ $record->title ?? ($title ?? 'Lelang') }}" />


        <!--Start Post Archive-->
        <section id="post-archive"
            class="flex flex-col gap-9 lg:gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

            <!--Title-->
            <div class="flex flex-col lg:flex-row lg:items-start gap-5 lg:gap-25">
                <h2 class="lg:w-1/3" data-aos="fade-up">
                    Pedoman Lelang
                </h2>

                <div class="lg:w-2/3 flex flex-col gap-5">
                    {!! $record->content ?? '' !!}
                    <!--button-->
                    <a class="w-fit btn1 mt-5" data-aos="fade-down" href="#">Unduh Pedoman
                        <x-icon.download-icon-current />
                    </a>
                </div>

            </div>

            <!--Content-->
            @if ($items->isNotEmpty())
                <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-7">
                    @foreach ($items as $item)
                        <x-loop.artikel-berita :item="$item" />
                    @endforeach
                </div>
            @else
                <x-partials.post-not-found />
            @endif

            {{ $items->links() }}

        </section>
        <!--End Post Archive-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>