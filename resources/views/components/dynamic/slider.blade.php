@php
    $heightBlock = collect($componentData->block)
        ->firstWhere('data.block_id', 'height');
    // Extract its data, or empty array if not found
    $heightData = $heightBlock['data'] ?? [];

    // Build the slider height array with fallbacks
    $sliderHeight = [
        'heightDesktop' => [
            'unit' => $heightData['unit'] ?? 'vh',
            'value' => $heightData['desktop'] ?? 120,
        ],
        'heightTablet' => [
            'unit' => $heightData['unit'] ?? 'vh',
            'value' => $heightData['tablet'] ?? 70,
        ],
        'heightMobile' => [
            'unit' => $heightData['unit'] ?? 'vh',
            'value' => $heightData['mobile'] ?? 100,
        ],
    ];

    $sliderBaseHeightVideoScale = (function () use ($sliderHeight) {
        $baseHeight = 1;
        $baseScale = [
            'desktop' => 0.012, //hardcode?
            'tablet' => 0.025, //hardcode?
            'mobile' => 0.035, //hardcode?
        ];

        $viewportHeightPx = [
            'desktop' => 850, //hardcode?
            'tablet' => 850, //hardcode?
            'mobile' => 650, //hardcode?
        ];

        $convertToVh = function ($value, $unit, $device) use ($viewportHeightPx) {
            if ($unit === 'px') {
                return ($value / $viewportHeightPx[$device]) * 100; // px -> vh
            }
            return $value; // kalau sudah vh, biarkan saja
        };

        $desktopHeight = $convertToVh($sliderHeight['heightDesktop']['value'], $sliderHeight['heightDesktop']['unit'], 'desktop');
        $tabletHeight = $convertToVh($sliderHeight['heightTablet']['value'], $sliderHeight['heightTablet']['unit'], 'tablet');
        $mobileHeight = $convertToVh($sliderHeight['heightMobile']['value'], $sliderHeight['heightMobile']['unit'], 'mobile');

        return [
            'baseHeight' => $baseHeight,
            'baseScale' => $baseScale,
            'desktopHeight' => $desktopHeight,
            'tabletHeight' => $tabletHeight,
            'mobileHeight' => $mobileHeight,
            'scaleDesktop' => $baseScale['desktop'] * ($desktopHeight / $baseHeight),
            'scaleTablet' => $baseScale['tablet'] * ($tabletHeight / $baseHeight),
            'scaleMobile' => $baseScale['mobile'] * ($mobileHeight / $baseHeight),
        ];
    })();

    // 1️⃣ Collect all "slider-with-counter" blocks from CMS
    $sliderBlocks = collect($componentData->block)
        ->where('data.block_id', 'slider');
    if ($sliderBlocks->isNotEmpty()) {
        $sliderHome = $sliderBlocks->map(function ($block) {
            $data = $block['data'];

            return [
                'slide' => [
                    'background' => $data['image_url'] ?? Storage::url('media/hero-home-2.jpg'),
                    'backgroundVideo' => $data['video'] ?? '',
                    'title' => $data['title'] ?? '',
                    'desc' => $data['description'] ?? '',
                    'image' => $data['logo_url'] ?? '',
                    'filterImageWhite' => $data['filter'] ?? false,
                    'btnText' => $data['cta_label'] ?? '',
                    'btnLink' => $data['cta'] ?? '#',
                    'counter' => [
                        'title' => $data['counter_title'] ?? '',
                        'items' => collect($data['counter_items'] ?? [])->map(function ($item) {
                            return [
                                'counter' => $item['number'] ?? 0,
                                'suffix' => $item['suffix'] ?? '',
                                'label' => $item['label'] ?? '',
                            ];
                        })->toArray(),
                    ],
                ],
            ];
        })->values()->toArray();
    } else {
        // fallback to hardcoded slides if CMS is empty
        $sliderHome = $fallbackSlides;
    }
@endphp


<!--Start Hero Banner-->
<section id="hero-banner" class="relative bg-cover bg-center overflow-hidden">
    <div class="swiper swiper-hero">
        <div class="swiper-wrapper relative">


            @foreach ($sliderHome as $item)
                <x-loop.slide-hero-home :slide="$item['slide']" :height="$sliderHeight"
                    :scale="$sliderBaseHeightVideoScale" />
            @endforeach

        </div>

        <!-- Custom icon.arrow Left -->
        <div
            class="swiper-button-prev bg-[var(--white-transparent)] hover:bg-[var(--color-blue)] rounded-[100%] sm:!h-[30px] sm:!w-[30px] !h-[20px] !w-[20px] p-1 cursor-pointer">
            <x-icon.arrow-left-white />
        </div>

        <!-- Custom icon.arrow Right -->
        <div
            class="swiper-button-next bg-[var(--white-transparent)] hover:bg-[var(--color-blue)] rounded-[100%] sm:!h-[30px] sm:!w-[30px] !h-[20px] !w-[20px] p-1 cursor-pointer">
            <x-icon.arrow-right-white />
        </div>
    </div>
</section>

<!--End Hero Banner-->