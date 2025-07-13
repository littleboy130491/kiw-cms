@php
    $languages = [
        'en' => ['flag' => 'english.jpg', 'display' => 'EN'],
        'zh-cn' => ['flag' => 'mandarin.jpg', 'display' => 'CN'],
        'ko' => ['flag' => 'korea.jpg', 'display' => 'KR'],
        'id' => ['flag' => 'indonesia.jpg', 'display' => 'ID'],
    ];

    $slugParam = match (Route::current()->getName()) {
        'cms.single.content' => 'content_slug',
        'cms.taxonomy.archive' => 'taxonomy_slug',
        'cms.archive.content' => 'content_type_archive_key',
        default => 'page_slug'
    };
@endphp

<div class="flex flex-row gap-5 items-center text-white">
    @foreach($languages as $langCode => $langData)
        @php
            // Get the localized slug for this language
            $localizedSlug = $globalItem && method_exists($globalItem, 'getTranslation')
                ? $globalItem->getTranslation('slug', $langCode, false)
                : null;

            // Use localized slug if available, otherwise use current slug
            $slugValue = $localizedSlug ?: ($globalItem->slug ?? Route::current()->parameter($slugParam));

            // Build parameters for this language
            $languageParams = array_merge(Route::current()->parameters(), [
                'lang' => $langCode,
                $slugParam => $slugValue
            ]);
        @endphp

        <a href="{{ route(Route::currentRouteName(), $languageParams) }}"
            class="hover:text-[var(--color-lightblue)] border-r border-[var(--color-bordertransparent)] pr-5 flex flex-row gap-2 items-center{{ app()->getLocale() === $langCode ? ' font-bold text-[var(--color-lightblue)]' : '' }}">
            <img class="w-5 h-4" src="{{ Storage::url('media/' . $langData['flag']) }}" alt="{{ $langCode }}">
            {{ $langData['display'] }}
        </a>
    @endforeach
</div>