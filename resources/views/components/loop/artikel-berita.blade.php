@php
    $item_url = route('cms.single.content', [
        'lang' => app()->getLocale(),
        'content_type_key' => 'posts',
        'content_slug' => $item->slug,
    ]);
    $item_date = $item->published_at?->format('d-m-Y') ?? ($item->created_at?->format('d-m-Y') ?? '');
    $item_label = $item->categories->first()?->slug ?? '';
@endphp

<!-- Item -->
<div
    class="berita-item group transition-all duration-[500ms] relative flex flex-col !min-h-70 rounded-2xl overflow-hidden">

    <!-- Front -->
    <div class="grow gap-2 bg-cover flex flex-col bg-center"
        style="background-image: url('{{ $item->featuredImage->url ?? '' }}');">
        <div class="gradient-black-half grow px-6 py-6 h-full flex flex-col justify-end">
            <div class="h-fit flex flex-col gap-2">
                <div class="flex flex-row gap-5">
                    <div class="flex flex-row items-center gap-2">
                        <x-icon.tag-icon-white />
                        <p class="!text-white">{{ $item_label }}</p>
                    </div>
                    <div class="flex flex-row items-center gap-2">
                        <x-icon.calendar-icon-white />
                        <p class="!text-white">
                            {{ $item_date }}
                        </p>
                    </div>
                </div>
                <h5 class="!text-white ellipsis">
                    {{ $item->title ?? '' }}
                </h5>
            </div>
        </div>
    </div>

    <!-- Back -->
    <div
        class="absolute group-hover:top-[0%] top-[100%] transition-all duration-[500ms] flex flex-col justify-between bg-white gap-15 px-6 pt-6 h-full w-full">

        <!-- Informasi dan Tanggal -->
        <div class="flex flex-col gap-5">
            <div class="flex flex-row gap-4">
                <div class="flex flex-row items-center gap-2">
                    <x-icon.tag-icon-color />
                    <p class="!text-[var(--color-purple)]">{{ $item_label }}</p>
                </div>
                <div class="flex flex-row items-center gap-2">
                    <x-icon.calendar-icon-color />
                    <p class="!text-[var(--color-purple)]">
                        {{ $item_date }}</p>
                </div>
            </div>
            <h5 class="ellipsis">
                {{ $item->title ?? '' }}
            </h5>
        </div>

        <!-- Tombol Selengkapnya -->
        <div class="flex flex-col gap-5">
            <div class="mt-3">
                <a class="w-full btn3" href="{{ $item_url ?? '' }}">
                    <span class="gradient-text">Selengkapnya</span>
                    <span class="gradient-icon">
                        <x-icon.arrow-right-gradient />
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
