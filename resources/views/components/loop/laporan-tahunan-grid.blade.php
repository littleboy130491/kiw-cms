@props([
    'qty' => 6,
])

@php
    use App\Models\Report;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;
    
    $items = Report::with(relations: ['fileMedia'])
        ->where('status', ContentStatus::Published)
        ->limit($qty)
        ->orderByDesc('created_at')
        ->get();
@endphp
<!--Content-->
@if ($items->isNotEmpty())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-7">
        @foreach ($items as $item)
           <x-loop.laporan-tahunan :item="$item" />
        @endforeach
    </div>
@else
    <x-partials.post-not-found />
@endif