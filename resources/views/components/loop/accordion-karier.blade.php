@php
    $image_url = $item->featuredImage->url;
@endphp
<div class="accordion-item border-b border-[var(--color-border)]">
    <button
        class="accordion-header flex flex-row w-full justify-between items-center pb-7 lg:pb-10 focus:outline-none cursor-pointer">
        <div class="flex flex-col lg:flex-row gap-2 lg:gap-5">
            <p class="border border-[var(--color-blue)] rounded-full px-3 py-1 lg:px-4 w-fit text-[var(--color-blue)] uppercase"
                data-aos="fade-down">
                {{ $item->careerCategories->first()?->title ?? 'Fulltime' }}
            </p>
            <h4 class="text-left" data-aos="fade-up">{{ $item->title ?? 'Karier' }}</h4>
        </div>

        <x-icon.arrow-accordion />
    </button>

    <div class="accordion-content overflow-hidden max-h-0 transition-all duration-300">
        <div
            class ="border-t border-[var(--color-border)] flex flex-col sm:flex-row sm:justify-between gap-6 lg:gap-16 py-5 lg:py-10">

            @if (!empty($item->featured_image))
                <div class="flex flex-col gap-6 mb-4 sm:mb-6">
                    <a href="{{ $image_url }}" data-lightbox="gallery">
                        <x-curator-glider :media="$item->featuredImage" class="w-full object-contain rounded-md" loading="lazy"/>
                    </a>
                </div>
            @endif

            <div class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    {!! $item->content ?? '' !!}
                </div>

                <!--button-->
                @if ($item->cta)
                    <a class="w-fit btn1 mt-5"data-aos="fade-down" href="{{ $item->cta ?? '' }}" target="_blank">Lamar
                        Pekerjaan
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </a>
                @endif
            </div>



        </div>

    </div>
</div>
