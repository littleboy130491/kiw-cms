<x-layouts.app :title="$item->title ?? 'Default Page'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>
        test
        <h1>{{ $item->title ?? 'Default Page' }}</h1>
        <x-instagram-feed :type="request('type', 'all')" />

        {{-- Content goes here --}}

    </main>
    <x-partials.footer />
</x-layouts.app>
