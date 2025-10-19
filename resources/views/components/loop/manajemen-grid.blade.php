@if ($items->isNotEmpty())
    <div class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">
        @if($level)
            <h2 class="mb-6 text-center">{{ $level }}</h2>
        @endif
        <div class="manajemen {{ $item->position ?? '' }} grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-9">
            @foreach ($items as $item)
                <x-loop.manajemen-item-popup :item="$item" />
            @endforeach
        </div>
    </div>
@endif