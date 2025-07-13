@props([
    'position' => '',
    'items' => null,
])

@php
// Ensure items is a collection or convert to collection
$items = collect($items ?? []);

// Filter by position if provided
if ($position && $items->isNotEmpty()) {
    $items = $items->filter(function ($item) use ($position) {
        return isset($item->position) && $item->position == $position;
    });
}
@endphp

@if ($items->isNotEmpty())
    <div class="manajemen {{ $position }} grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-9 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">
        @foreach ($items as $item)
            <x-loop.manajemen-item-popup :item="$item" />
        @endforeach
    </div>
@endif