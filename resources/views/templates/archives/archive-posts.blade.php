<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="isset($record->featuredImage) ? $record->featuredImage->url : Storage::url('media/berita-hero.jpg')" h1="{{ $record->title ?? ($title ?? 'Berita Perusahaan') }}" />
        <!--Start Post Archive-->
        <livewire:post-search :currentUrl="request()->url()" :content="$record->content ?? ''" />
        <!--End Post Archive-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>