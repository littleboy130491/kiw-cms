@php
    $videos = collect($componentData->block)
    ->pluck('data.url')
    ->filter() // remove null if any
    ->values()
    ->toArray();
@endphp
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
    @foreach ($videos as $video)
        <x-loop.youtube :src="$video" />
    @endforeach
</div>