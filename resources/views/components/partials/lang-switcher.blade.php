{{-- components/language-switcher.blade.php --}}
@props([
    'variant' => 'desktop', // 'desktop' or 'mobile'
    'class' => ''
])

@php
$globalItem = $globalItem ?? null;

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

$defaultLanguage = config('cms.default_language');
$currentRoute = Route::current();
$currentParams = $currentRoute->parameters();

// Styling based on variant
$containerClasses = match($variant) {
    'mobile' => 'mt-10 flex flex-row gap-5 items-center text-[var(--color-heading)]',
    default => 'flex flex-row gap-5 items-center text-white'
};

$linkBaseClasses = match($variant) {
    'mobile' => 'hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center',
    default => 'hover:text-[var(--color-lightblue)] border-r border-[var(--color-bordertransparent)] pr-5 flex flex-row gap-2 items-center'
};

// Inline slug resolution logic to avoid function redefinition
$getSlugForLanguage = function($globalItem, $langCode, $slugParam, $defaultLanguage) {
    if (!$globalItem || !method_exists($globalItem, 'getTranslation')) {
        return Route::current()->parameter($slugParam);
    }
    
    // Get the localized slug for this language
    $localizedSlug = $globalItem->getTranslation('slug', $langCode, false);
    
    // Get the default language slug as fallback
    $defaultSlug = $defaultLanguage 
        ? $globalItem->getTranslation('slug', $defaultLanguage, false)
        : null;
    
    // Use localized slug if available, then default language slug, otherwise current slug
    return $localizedSlug 
        ?: ($defaultSlug ?: ($globalItem->slug ?? Route::current()->parameter($slugParam)));
};
@endphp

<div class="{{ $containerClasses }} {{ $class }}">
    @foreach($languages as $langCode => $langData)
        @php
            $slugValue = $getSlugForLanguage($globalItem, $langCode, $slugParam, $defaultLanguage);
            
            $languageParams = array_merge($currentParams, [
                'lang' => $langCode,
                $slugParam => $slugValue
            ]);
            
            $isActive = app()->getLocale() === $langCode;
            $activeClasses = $isActive ? ' font-bold text-[var(--color-lightblue)]' : '';
        @endphp
        
        <a href="{{ route($currentRoute->getName(), $languageParams) }}"
           class="{{ $linkBaseClasses }}{{ $activeClasses }}">
            <img class="w-5 h-4" 
                 src="{{ Storage::url('media/' . $langData['flag']) }}" 
                 alt="{{ $langCode }}">
            {{ $langData['display'] }}
        </a>
    @endforeach
</div>