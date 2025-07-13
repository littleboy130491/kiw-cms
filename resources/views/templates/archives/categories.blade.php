<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$record->featuredImage->url ?? Storage::url('media/berita-hero.jpg')"
            h1="{{ $record->title ?? ($title ?? 'Berita Perusahaan') }}" />

        <!--Start Post Archive-->
        <section id="post-archive"
            class="flex flex-col gap-9 lg:gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

            <!--Top Bar-->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 z-50">

                <!--Title-->
                <h2 class="text-center sm:text-left" data-aos="fade-up">Temukan Berita Terbaru</h2>

                <!--Field-->
                <div class="flex flex-col sm:flex-row-reverse gap-2 sm:w-1/2 lg:w-1/3" data-aos="fade-down">

                    <!--Search-->
                    <div class="relative max-w-md w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <img src="{{ Storage::url('media/search.png') }}">
                        </div>
                        <input type="search" placeholder="Cari disini..."
                            class="w-full pl-10 pr-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:var(--color-blue)" />
                    </div>

                    <x-partials.category-dropdown :slug="$record->slug" />
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