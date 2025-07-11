<x-layouts.app :title="$title ?? 'Archive'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>
        <h1>{{ $archive->name ?? 'Archive' }}</h1>
        @if (!empty($archive->description))
            <p>{{ $archive->description }}</p>
        @endif

        {{-- Loop through posts --}}
        @forelse ($items as $item)
            <article>
                <h2>{{ $item->title ?? 'Untitled' }}</h2>
                {{-- Display excerpt or content --}}
                <p>{{ $item->excerpt ?? Str::limit($item->content, 150) }}</p>
                <a href="{{ url($lang . '/' . ($item->post_type ?? 'post') . '/' . $item->slug) }}">Read More</a>
            </article>
        @empty
            <p>No content found for this archive.</p>
        @endforelse

        {{-- Pagination links --}}
        @if (method_exists($items, 'links'))
            {{ $items->links() }}
        @endif

    </main>
    <x-partials.footer />
</x-layouts.app>
