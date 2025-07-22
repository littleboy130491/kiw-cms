@php
    $item_url = route('cms.single.content', [
        'lang' => app()->getLocale(),
        'content_type_key' => 'tenders',
        'content_slug' => $item->slug,
    ]);
@endphp
<div class="tender-loop relative flex flex-col justify-between bg-white gap-15 pb-0 pt-12 px-6 rounded-md">
    <div
        class="gradient-blue top-0 left-0 w-fit absolute px-3 py-2 rounded-tl-md rounded-br-md {{ $item->tenderStatus->first()?->slug === 'terbaru' ? 'blinking' : '' }}">
        <p class="text-white uppercase text-[.8em]">{{ $item->tenderStatus->first()?->title ?? 'terbaru' }}</p>
    </div>
    <div class="flex flex-col gap-4">
        <a href="{{ $item_url ?? '#' }}">
            <h4 class="ellipsis">
                {{ $item->title ?? '' }}
            </h4>
        </a>
        <p class="ellipsis">
            {{ $desc ?? '' }}
        </p>
        <div class="flex flex-row items-center gap-2">
            <x-icon.calendar-icon-color />
            <p class="!text-[var(--color-purple)]">
                @foreach ($item->specification as $spec)
                    @dd($item->specification)
                    @if (Str::of($spec['name'])->lower()->contains('tanggal'))
                        {{ $spec['value'] }}
                        @break
                    @endif
                @endforeach
            </p>
        </div>
    </div>

    <div class="flex flex-col gap-5 mt-3">
        <a class="w-full btn3" href="{{ $item_url ?? '#' }}">
            <span class="gradient-text">Selengkapnya</span>
            <span class="gradient-icon">
                <x-icon.arrow-right-gradient />
            </span>
        </a>
    </div>
</div>
