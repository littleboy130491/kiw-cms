<x-layouts.app :title="$item->title ?? 'Penghargaan & Sertifikasi'" :body-classes="$bodyClasses">
    <x-partials.header />

    <main>
        <x-partials.hero-page :image="Storage::url('media/penghargaan-hero.jpg')" h1="Penghargaan & Sertifikasi" />

        <livewire:achievements-list />
    </main>

    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>