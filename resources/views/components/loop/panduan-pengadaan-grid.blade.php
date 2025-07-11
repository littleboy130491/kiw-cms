@php
    use App\Models\Guide;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Guide::with('fileMedia')->where('status', ContentStatus::Published)->get();
@endphp
@if ($items->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
        @foreach ($items as $item)
            <x-loop.panduan-pengadaan :item="$item" />
        @endforeach
    </div>
@endif
