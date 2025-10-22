@php
    $block = collect($record->block);
    $section = $block->where('data.block_id', 'section-1')->first();

    $heading = $section['data']['title'] ?: __('career.archive_heading');
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="isset($record->featuredImage) ? $record->featuredImage->url : Storage::url('media/karier-hero.jpg')"
            h1="{{ strip_tags($record->content) ?? ($record->title ?? 'Lowongan Kerja') }}" />
        <!--Start Karier Content-->

        <section id="karier"
            class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto flex flex-col gap-8">

            <h2 data-aos="fade-up">{{ $heading }}</h2>

            <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5">

                @foreach ($items as $item)
                    <x-loop.karir-grid :item="$item" />
                @endforeach
            </div>
        </section>

        <!--End Karier Content-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>