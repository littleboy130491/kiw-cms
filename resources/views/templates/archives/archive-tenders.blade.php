<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="isset($record->featuredImage) ? $record->featuredImage->url : Storage::url('media/tender-hero.jpg')" h1="{{ $record->title ?? ($title ?? 'Tender') }}" />
        <!--Start Tender-->
        <livewire:tender-search :currentUrl="request()->url()" :content="$record?->content ?? ''" />
        <!--End Tender-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
