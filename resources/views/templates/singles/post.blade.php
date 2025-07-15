@php
    $item_date = $item->published_at?->format('d-m-Y') ?? ($item->created_at?->format('d-m-Y') ?? '');
    $item_label = $item->categories->first()?->slug ?? '';
    $archive_post_url = $item_url = route('cms.archive.content', [
        'lang' => app()->getLocale(),
        'content_type_archive_key' => 'posts',
    ]);
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url" />

        <!--Start Post Content-->

        <section id="single-tender"
            class="flex flex-col lg:flex-row gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

            <!--Main Content-->
            <div class="flex flex-col gap-7 lg:gap-9">

                <!--Top-->
                <div class="flex flex-col gap-5">
                    <!--Meta-->
                    <div data-aos="fade-down" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex flex-row gap-4 w-fit px-3 py-2 rounded-full bg-[var(--color-transit)]">
                            <div class="flex flex-row items-center gap-2">
                                <x-icon.tag-icon-color />
                                <p class="!text-[var(--color-purple)] capitalize">{{ $item_label }}</p>
                            </div>
                            <div class="flex flex-row items-center gap-2">
                                <x-icon.calendar-icon-color />
                                <p class="!text-[var(--color-purple)]">{{ $item_date }}</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-4 w-fit">
                            <!--like-->
                            <livewire:like-button />

                            <!--view-->
                            <div class="flex flex-row gap-1 items-center">
                                <img class="w-[15px]" src="{{ Storage::url('media/view.png') }}">
                                <span id="like-text"
                                    class="text-[var(--color-purple)]">{{ $item->getPageViewsAttribute() }}</span>
                            </div>
                        </div>
                    </div>
                    <!--Title-->
                    <h2 data-aos="fade-up">
                        {{ $item->title }}
                    </h2>
                </div>

                <!--Content-->
                <div class="flex flex-col gap-5">
                    {!! $item->content !!}
                    <!--Gallery-->

                    <x-loop.gallery-grid :gallery="$item->gallery" />

                </div>
                <!--button-->
                <a class="w-fit btn1 back mt-5" data-aos="fade-down" href="{{ $archive_post_url }}">Kembali
                    <span>
                        <x-icon.arrow-back-white />
                    </span>
                </a>
            </div>

        </section>

        <!--End Post Content-->

        <!-- Start Comment Section -->
        @if(!($item->custom_fields['disable_comments'] ?? false))
            <livewire:comments :post="$item" />
        @endif
        <!-- End Comment Section -->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>