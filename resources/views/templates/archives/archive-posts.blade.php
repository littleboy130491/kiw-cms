<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$record->featuredImage->url ?? Storage::url('media/berita-hero.jpg')" h1="{{ $record->title ?? 'Berita Perusahaan' }}" />
        <!--Start Post Archive-->
        <livewire:post-search :currentUrl="request()->url()" />
        <!--End Post Archive-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
