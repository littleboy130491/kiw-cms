@php
    $tender_archive_url = route('cms.page', [
        'lang' => app()->getLocale(),
        'slug' => 'tenders',
    ]);
    $item_image = $item->featuredImage?->url ?? Storage::url('media/content-default.jpg');
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="Storage::url('media/tender-hero.jpg')" h1="{{ __('tender.title') }}" />

        <!--Start Single Tender-->
        <section id="single-tender"
            class="flex flex-col lg:flex-row gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

            <!--Main Content-->
            <div class="flex flex-col gap-10 lg:w-2/3">
                <!--featured image-->

                <img class="rounded-md rounded-b-none w-full h-full object-cover object-top" src="{{ $item_image }}">


                <!--Title-->
                <div class="flex flex-col gap-5">
                    <div data-aos="fade-down" class="flex flex-row gap-4">
                        <div class="flex flex-row items-center gap-2">
                            <x-icon.tag-icon-color />
                            <p class="!text-[var(--color-purple)]">{{ $item->tenderStatus->first()?->title }}</p>
                        </div>
                        <div class="flex flex-row items-center gap-2">
                            <x-icon.location-icon-color />
                            <p class="!text-[var(--color-purple)]">{{ $item->tenderLocation->first()?->title }}</p>
                        </div>
                    </div>
                    <h2 data-aos="fade-up">
                        {{ $item->title }}
                    </h2>
                </div>

                <!--Content-->
                <div class="flex flex-col gap-5">
                    <p>
                        {!! $item->content !!}
                    </p>
                    <div class="flex flex-col gap-3">
                        @foreach ($item->specification as $spec)
                            <x-loop.item-single-tender :spec="$spec" />
                        @endforeach
                    </div>
                </div>
                <!--button-->
                <a class="w-fit btn1 back mt-5 lg:!flex !hidden" data-aos="fade-down"
                    href="{{ $tender_archive_url }}">{{ __('common.back') }}
                    <span>
                        <x-icon.arrow-back-white />
                    </span>
                </a>
            </div>

            <!--Milestone-->
            <div class="flex flex-col gap-9 p-6 lg:p-8 h-fit bg-[var(--color-transit)] rounded-md lg:w-1/3">

                <!--Title-->
                <div class="flex flex-col gap-5">
                    <div
                        class="gradient-blue top-0 left-0 w-fit px-3 py-2 rounded-md {{ $item->tenderStatus->first()?->slug === 'terbaru' ? 'blinking' : '' }}">
                        <p class="text-white uppercase text-[.8em]">
                            {{ $item->tenderStatus->first()?->title ?: __('tender.latest') }}
                        </p>
                    </div>

                    <div>
                        <h3 data-aos="fade-up">{{ __('tender.process_stages') }}</h3>
                    </div>
                </div>

                <!--Milestone-->
                @if($item->process)
                    <div class="milestone flex flex-col relative">
                        @foreach ($item->process as $process)
                            <x-loop.milestone :process="$process" />
                        @endforeach
                    </div>
                @endif

            </div>

            <!--button mobile only-->
            <a class="w-fit btn1 mobile-only back -mt-7 lg:hidden" data-aos="fade-down"
                href="{{ $tender_archive_url }}">{{ __('common.back') }}
                <span>
                    <x-icon.arrow-back-white />
                </span>
            </a>

        </section>
        <!--End Single Tender-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>