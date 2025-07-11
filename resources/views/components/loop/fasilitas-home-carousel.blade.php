@php
    use App\Models\Facility;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Facility::with('featuredImage')->where('status', ContentStatus::Published)->get();
@endphp

@if ($items->isNotEmpty())
    <div class="sm:!w-[55%] !w-[100%] relative fasilitas-home">
        <div class="swiper swiper-1">
            <div class="swiper-wrapper">
                @foreach ($items as $item)
                    <x-loop.fasilitas-home-loop :item="$item" :iteration="$loop->iteration" />
                @endforeach
            </div>

        </div>
        <!-- Custom icon.arrow Left -->
        <div class="swiper-button-prev gradient-blue rounded-[100%] !h-[30px] !w-[30px] p-1 ">
            <x-icon.arrow-left-white />
        </div>

        <!-- Custom icon.arrow Right -->
        <div class="swiper-button-next gradient-blue  rounded-[100%] !h-[30px] !w-[30px] p-1">
            <x-icon.arrow-right-white />
        </div>

    </div>
@endif
