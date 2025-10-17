@props([
    'qty' => 4,
])

@php
    use App\Models\Post;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;
    
    $items = Post::with(['featuredImage', 'categories', 'tags'])
        ->where('status', ContentStatus::Published)
        ->limit($qty)
        ->orderByRaw('COALESCE(published_at, created_at) DESC')
        ->get();

@endphp
<!--Content-->
@if ($items->isNotEmpty())
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-7">
        @foreach ($items as $item)
            <x-loop.artikel-berita :item="$item" />
        @endforeach
    </div>
@else
    <x-partials.post-not-found />
@endif