@php
    $languages = [
        'en' => ['flag' => 'english.jpg', 'display' => 'GB'],
        'zh' => ['flag' => 'mandarin.jpg', 'display' => 'CN'],
        'ko' => ['flag' => 'korea.jpg', 'display' => 'KR'],
        'id' => ['flag' => 'indonesia.jpg', 'display' => 'ID'],
    ];
@endphp
@props(
    ['slug']
)
<div class="mt-10 flex flex-row gap-5 items-center text-[var(--color-heading)]">
    @foreach($languages as $langCode => $langData)
        <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['lang' => $langCode])) }}"
            class="hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center {{ app()->getLocale() === $langCode ? 'font-bold text-[var(--color-lightblue)]' : '' }}">
            <img class="w-5 h-4" src="{{ Storage::url('media/' . $langData['flag']) }}" alt="{{ $langCode }}">
            {{ $langData['display'] }}
        </a>
    @endforeach
</div>