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
   $thumbnailLaporanHome = Storage::url('media/dadc9265-8fd2-4f59-92af-7869b39f6272.png');
@endphp
<!--Content-->
@if ($items->isNotEmpty())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-7">
        @foreach ($items as $item)
           <x-loop.laporan-tahunan :item="$item" :image="$thumbnailLaporanHome" />
        @endforeach
    </div>
@else
    <x-partials.post-not-found />
@endif