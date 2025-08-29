@php
    use App\Models\Report;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Report::with('fileMedia')->where('status', ContentStatus::Published)->get();
    
    /*Revisi penambahan cover image*/
    $image = Storage::url('media/ad3bb3b5-7931-4fae-85e5-8a266e55bfe5.jpg');
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/laporan-tahunan-hero.jpg')"
            h1="{{ $item->title ?? 'Laporan Tahunan' }}" />

        <!--Start Laporan Tahunan-->

        <section id="laporan-tahunan" class="my-18 lg:my-30 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">
            @if ($items->isNotEmpty())
                <div data-aos="zoom-in-up" class="overflow-x-auto w-full flex flex-row pl-4 sm:px-0">
                    <table
                        class="grow min-w-[900px] sm:min-w-[100%] text-left text-[var(--color-heading)] bg-[var(--color-transit)] rounded-md">
                        <thead class="text-[var(--color-heading)] border-b border-[var(--color-border)]">
                            <tr>
                                <th class="px-6 py-3">Cover</th>
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Size</th>
                                <th class="px-6 py-3">Format</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3 flex flex-row justify-center">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <x-loop.table-data :item="$item" :cover="$image"/>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @endif
        </section>


        <!--End Laporan Tahunan-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>