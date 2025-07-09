@php
    use App\Models\Guide;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $posts = Guide::with('fileMedia')->where('status', ContentStatus::Published)->get();
@endphp
@if ($posts->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
        @foreach ($posts as $post)
            <x-loop.panduan-pengadaan :post="$post" />
        @endforeach
    </div>
@endif
