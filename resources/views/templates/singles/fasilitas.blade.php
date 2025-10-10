@php
    use App\Models\Facility;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Facility::with('featuredImage')->where('status', ContentStatus::Published)->get();
    $fasilitasUtama = $items->where('facility_category', 'utama');
    $fasilitasPenunjang = $items->where('facility_category', 'penunjang');
    $fasilitasTitle = [
        'fasilitasUtama' => 'Fasilitas Utama',
        'fasilitasPenunjang' => 'Fasilitas Penunjang',
        ];
    
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/fasilitas-hero.jpg')" h1="{{ strip_tags($item->content) ?? 'Fasilitas' }}" />


        <!--Start Fasilitas Content-->
        <section id="fasilitas">
            @if($fasilitasUtama->isNotEmpty())
                <div class="flex flex-col gap-6 lg:max-w-[1200px] lg:mx-auto lg:gap-6 my-18 lg:my-30 lg:px-0 px-4 sm:px-6">
                    <h2>{{ $fasilitasTitle['fasilitasUtama'] }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <!--item-->
                    @foreach ($fasilitasUtama as $item)
                        <x-loop.fasilitas-loop :item="$item" />
                    @endforeach
                    </div>
                </div>
            @endif

            @if($fasilitasPenunjang->isNotEmpty())
                <div class="lg:py-30 py-18 bg-[var(--color-transit)]">
                    <div class="flex flex-col overflow-hidden relative lg:gap-9 sm:gap-7 gap-7 lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">
                        <h2>{{ $fasilitasTitle['fasilitasPenunjang'] }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($fasilitasPenunjang as $item)
                            <x-loop.fasilitas-loop :item="$item" />
                        @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <!--Popup Content-->
        <x-popup-content.fasilitas-popup />

        <!--End Fasilitas Content-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
