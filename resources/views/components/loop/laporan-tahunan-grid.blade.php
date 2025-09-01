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
   $backgroundHome = Storage::url('media/1c5403f2-a698-4715-8ae0-3bd76d765b8a.jpg');
@endphp
<!--Content-->
@if ($items->isNotEmpty())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-7">
        @foreach ($items as $item)
           <x-loop.laporan-tahunan :item="$item" :backgroundHome="$backgroundHome" />
        @endforeach
    </div>
@else
    <x-partials.post-not-found />
@endif