@php
    use App\Models\Facility;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Facility::with('featuredImage')->where('status', ContentStatus::Published)->get();
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/fasilitas-hero.jpg')" h1="{{ strip_tags($item->content) ?? 'Fasilitas Penunjang' }}" />


        <!--Start Fasilitas Content-->
        <section id="fasilitas"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

            <!--item-->
            @foreach ($items as $item)
                <x-loop.fasilitas-loop :item="$item" />
            @endforeach

        </section>

        <!--Popup Content-->
        <x-popup-content.fasilitas-popup />

        <!--End Fasilitas Content-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
