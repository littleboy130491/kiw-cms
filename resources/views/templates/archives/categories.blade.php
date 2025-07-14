<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$record->featuredImage->url ?? Storage::url('media/berita-hero.jpg')" h1="{{ $record->title ?? ($title ?? 'Berita Perusahaan') }}" />
        <!--Start Post Archive-->
        <livewire:post-search :relation="$contentTypeKey" :slug="$globalItem->slug" :currentUrl="request()->url()" />
        <!--End Post Archive-->


        </section>
        <!--End Post Archive-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
