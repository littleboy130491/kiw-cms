@php
    use App\Models\Report;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Report::with(['fileMedia', 'featuredImage'])
        ->where('status', ContentStatus::Published)
        ->orderBy('published_at', 'desc')
        ->get();
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/laporan-tahunan-hero.jpg')"
            h1="{{ $item->title ?? __('laporan-tahunan.title') }}" />

        <!--Start Laporan Tahunan-->

        <section id="laporan-tahunan"
            class="my-18 lg:my-30 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto px-4 py-18">
            @if ($items->isNotEmpty())
                <div data-aos="zoom-in-up" class="overflow-x-auto w-full flex flex-row pl-4 sm:px-0">
                    <table
                        class="grow min-w-[900px] sm:min-w-[100%] text-left text-[var(--color-heading)] bg-[var(--color-transit)] rounded-md">
                        <thead class="text-[var(--color-heading)] border-b border-[var(--color-border)]">
                            <tr>
                                <th class="px-6 py-3">{{ __('laporan-tahunan.table_headers.cover') }}</th>
                                <th class="px-6 py-3">{{ __('laporan-tahunan.table_headers.title') }}</th>
                                <th class="px-6 py-3">{{ __('laporan-tahunan.table_headers.size') }}</th>
                                <th class="px-6 py-3">{{ __('laporan-tahunan.table_headers.format') }}</th>
                                <th class="px-6 py-3">{{ __('laporan-tahunan.table_headers.date') }}</th>
                                <th class="px-6 py-3 flex flex-row justify-center">
                                    {{ __('laporan-tahunan.table_headers.download') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <x-loop.table-data :item="$item" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex justify-center ">
                    <x-partials.post-not-found />
                </div>
            @endif

        </section>


        <!--End Laporan Tahunan-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>