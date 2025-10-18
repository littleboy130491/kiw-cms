@props([
    'variant' => 'desktop', // 'desktop' or 'mobile'
    'class' => '',
])

@php
    $globalItem = $globalItem ?? null;

    // Get languages from CMS config
    $languageNames = config('cms.language_available', []);
    $languageFlags = config('cms.language_flags', []);
    $languageCodes = config('cms.language_codes', []);
    
    // Build languages array from config
    $languages = [];
    foreach ($languageNames as $langCode => $langName) {
        $languages[$langCode] = [
            'flag' => $languageFlags[$langCode] ?? 'default.jpg',
            'display' => $langName,
            'code' => $languageCodes[$langCode] ?? strtoupper($langCode),
        ];
    }

    $currentRoute = Route::current();

    // Handle 404 pages gracefully
    if (!$currentRoute) {
        $currentRouteName = null;
        $currentParams = [];
        $slugParam = 'slug'; // Default fallback
    } else {
        $currentRouteName = $currentRoute->getName();
        $currentParams = $currentRoute->parameters();

        $slugParam = match ($currentRouteName) {
            'cms.single.content' => 'content_slug',
            'cms.taxonomy.archive' => 'taxonomy_slug',
            'cms.page' => 'slug',
            default => 'slug',
        };
    }

    $defaultLanguage = config('cms.default_language');

    // Styling based on variant
    $containerClasses = match ($variant) {
        'mobile' => 'mt-10 flex flex-row gap-5 items-center text-[var(--color-heading)]',
        default => 'flex flex-row gap-5 items-center text-white',
    };

    $linkBaseClasses = match ($variant) {
        'mobile' => 'hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center',
        default
            => 'hover:text-[var(--color-lightblue)] border-r border-[var(--color-bordertransparent)] pr-5 flex flex-row gap-2 items-center',
    };

    // Inline slug resolution logic with 404 fallback
    $getSlugForLanguage = function ($globalItem, $langCode, $slugParam, $defaultLanguage) use ($currentRoute) {
        if (!$globalItem || !method_exists($globalItem, 'getTranslation')) {
            return $currentRoute ? $currentRoute->parameter($slugParam) : null;
        }

        // Get the localized slug for this language
        $localizedSlug = $globalItem->getTranslation('slug', $langCode, false);

        // Get the default language slug as fallback
        $defaultSlug = $defaultLanguage ? $globalItem->getTranslation('slug', $defaultLanguage, false) : null;

        // Use localized slug if available, then default language slug, otherwise current slug
        return $localizedSlug ?:
            ($defaultSlug ?:
                $globalItem->slug ?? ($currentRoute ? $currentRoute->parameter($slugParam) : null));
    };

    // Simple route generation with 404 fallback
    $generateLanguageUrl = function ($langCode) use (
        $currentRoute,
        $currentParams,
        $getSlugForLanguage,
        $globalItem,
        $defaultLanguage,
        $slugParam,
    ) {
        if (!$currentRoute) {
            // On 404 pages, route to home page in selected language
            return route('cms.home', $langCode);
        }

        $slugValue = $getSlugForLanguage($globalItem, $langCode, $slugParam, $defaultLanguage);

        $languageParams = array_merge($currentParams, [
            'lang' => $langCode,
            $slugParam => $slugValue,
        ]);

        return route($currentRoute->getName(), $languageParams);
    };
@endphp

<div class="{{ $containerClasses }} {{ $class }} translate-header">
    @foreach ($languages as $langCode => $langData)
        @php
            $isActive = app()->getLocale() === $langCode;
            $activeClasses = $isActive ? ' font-bold ' : '';
            $languageUrl = $generateLanguageUrl($langCode);
        @endphp

        <a href="{{ $languageUrl }}" class="{{ $linkBaseClasses }}{{ $activeClasses }}">
            <img class="w-5 h-4" src="{{ Storage::url('media/' . $langData['flag']) }}" alt="{{ $langCode }}">
            @if ($variant === 'mobile')
                {{ $langData['code'] }}
            @else
                {{ $langData['display'] }}
            @endif
        </a>
    @endforeach
</div>
