<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/tender-hero.jpg')" h1="Tender" />

        <!--Start Tender-->
        <livewire:tender-search :currentUrl="request()->url()" />
        <!--End Tender-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>