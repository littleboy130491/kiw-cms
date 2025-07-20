<?php

namespace App\Models;

use Littleboy130491\Sumimasen\Models\Page as BasePage;
use Datlechin\FilamentMenuBuilder\Concerns\HasMenuPanel;
use Datlechin\FilamentMenuBuilder\Contracts\MenuPanelable;

class Page extends BasePage implements MenuPanelable
{
    use HasMenuPanel;

    public function getMenuPanelTitleColumn(): string
    {
        return 'title';
    }

    public function getMenuPanelUrlUsing(): callable
    {
        $locale = app()->getLocale();
        return fn(self $model) => route('cms.static.page', [$locale, $model->slug]);
    }

    /**
     * Override spatie translatable to handle empty arrays and null values
     */
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true): mixed
    {
        $translations = $this->getTranslations($key);

        // Check if translation exists for requested locale
        if (array_key_exists($locale, $translations)) {
            $translation = $translations[$locale];

            // Check if translation is empty (null, empty string, or empty array)
            if ($this->isTranslationEmpty($translation)) {
                // If empty and fallback is enabled, try fallback locale
                if ($useFallbackLocale && $locale !== config('app.fallback_locale')) {
                    return $this->getTranslation($key, config('app.fallback_locale'), false);
                }
            }

            return $translation;
        }

        // Original behavior for non-existent locale
        return parent::getTranslation($key, $locale, $useFallbackLocale);
    }

    /**
     * Check if a translation value is considered empty
     */
    protected function isTranslationEmpty($value): bool
    {
        if (is_null($value)) {
            return true;
        }

        if (is_string($value) && trim($value) === '') {
            return true;
        }

        if (is_array($value) && empty($value)) {
            return true;
        }

        return false;
    }
}
