@if ($items->isNotEmpty())
    <div class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">
        @if($level)
            <h2 class="mb-6 text-center">{{ $level }}</h2>
        @endif
        <div class="manajemen {{ $level ?? '' }} flex flex-wrap justify-center gap-5 lg:gap-9">
            @foreach ($items as $item)
                <x-loop.manajemen-item-popup :item="$item"
                    class="flex-[0_0_calc(100%-20px)] sm:flex-[0_0_calc(50%-20px)] lg:flex-[0_0_calc(33.333%-30px)]" />
            @endforeach
        </div>
    </div>
@endif