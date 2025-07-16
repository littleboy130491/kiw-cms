<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$record->featuredImage->url"
            h1="{{ $record->title ?? $title ?? 'Bangunan Pabrik Siap Pakai' }}" />


        <!--Start Bangunan Pabrik-->

        <section id="bangunan-pabrik"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-10 lg:gap-20 lg:w-[1200px] lg:mx-auto">

            <!--Title-->
            <div class="flex flex-col lg:flex-row lg:items-center gap-5 lg:gap-10">
                <h2 data-aos="fade-up">
                    BPSP Modern & Fungsional
                </h2>
                <div class="flex flex-col gap-5">
                    <p class="sub-p" data-aos="fade-down">
                        {!! $record->content !!}
                    </p>
                    <p>
                        KIW juga siap mendirikan BPSP baru untuk memenuhi kebutuhan para investor dalam menjalankan
                        bisnis. Available BPSP 12 saat ini tersedia disewa dengan spesifikasi berikut.
                    </p>
                </div>
            </div>


            <!--Content-->
            @if ($items->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($items as $item)
                        <x-loop.bpsp :item="$item" />
                    @endforeach
                </div>
            @else
                <x-partials.post-not-found />
            @endif

            {{ $items->links() }}


        </section>

        <!--End Bangunan Pabrik-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>