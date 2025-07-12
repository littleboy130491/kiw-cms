@php
    $languages = [
        'en' => ['flag' => 'english.jpg', 'display' => 'EN'],
        'zh-cn' => ['flag' => 'mandarin.jpg', 'display' => 'CN'],
        'ko' => ['flag' => 'korea.jpg', 'display' => 'KR'],
        'id' => ['flag' => 'indonesia.jpg', 'display' => 'ID'],
    ];
@endphp

<div class="flex flex-row gap-5 items-center text-white ">
    @foreach($languages as $langCode => $langData)
        <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['lang' => $langCode])) }}"
            class="hover:text-[var(--color-lightblue)] border-r border-[var(--color-bordertransparent)] pr-5 flex flex-row gap-2 items-center{{ app()->getLocale() === $langCode ? 'font-bold text-[var(--color-lightblue)]' : '' }}">
            <img class="w-5 h-4" src="{{ Storage::url('media/' . $langData['flag']) }}" alt="{{ $langCode }}">
            {{ $langData['display'] }}
        </a>
    @endforeach
</div>