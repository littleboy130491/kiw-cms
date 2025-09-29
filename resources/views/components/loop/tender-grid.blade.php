@props(['qty' => 4])

@php
    use App\Models\Tender;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Tender::with(['tenderYear', 'tenderStatus', 'tenderLocation'])
        ->where('status', ContentStatus::Published)
        ->limit($qty)
        ->get();

    $image = Storage::url('media/a0e32957-9163-495b-813c-cc617f66dfc6.jpg')
@endphp

@if ($items->isNotEmpty())
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-7 lg:gap-5">

        @foreach ($items as $item)
            <x-loop.tender :item="$item" />
        @endforeach
    </div>
@endif
