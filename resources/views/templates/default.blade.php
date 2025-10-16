<x-layouts.app :title="$item->title ?? 'Default Page'">
    <x-partials.header />
        <main>
            <x-partials.hero-page :image="Storage::url('media/bangunan-pabrik-hero.jpg')" h1="{{ $item->title ?? '' }}" />

            {{-- Content goes here --}}

        </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>

