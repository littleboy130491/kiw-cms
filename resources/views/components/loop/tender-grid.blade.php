@props(['qty' => 4])

@php
    use App\Models\Tender;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $posts = Tender::with(['tenderYear', 'tenderStatus', 'tenderLocation'])
        ->where('status', ContentStatus::Published)
        ->limit($qty)
        ->get();
@endphp

@if ($posts->isNotEmpty())
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-7 lg:gap-5">

        @foreach ($posts as $post)
            <x-loop.tender :post="$post" />
        @endforeach
    </div>
@endif
