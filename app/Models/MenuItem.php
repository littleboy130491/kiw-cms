<?php
// app/Models/MenuItem.php - Temporary debug version

namespace App\Models;

use Datlechin\FilamentMenuBuilder\Models\MenuItem as BaseMenuItem;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MenuItem extends BaseMenuItem
{
    /**
     * Override the title attribute to handle translations
     */
    protected function title(): Attribute
    {
        return Attribute::get(function (string $value) {
            return $this->translateTitle($value);
        });
    }

    /**
     * Get the raw title without translation (useful for editing)
     */
    public function getRawTitleAttribute(): string
    {
        return $this->attributes['title'];
    }

    /**
     * Translate title - checks menu-specific translations first
     */
    private function translateTitle(string $title): string
    {
        // Add debugging
        \Log::info('=== TRANSLATION DEBUG ===');
        \Log::info('Original title: "' . $title . '"');
        \Log::info('Current locale: ' . app()->getLocale());

        // First, check if title contains translation variables like {{menu.tentang}}
        if (preg_match_all('/\{\{([^}]+)\}\}/', $title, $matches)) {
            \Log::info('Found {{}} syntax, processing...');
            $processedTitle = $title;

            foreach ($matches[1] as $translationKey) {
                $translatedValue = __($translationKey);

                // Only replace if translation exists
                if ($translatedValue !== $translationKey) {
                    $processedTitle = str_replace('{{' . $translationKey . '}}', $translatedValue, $processedTitle);
                }
            }

            return $processedTitle;
        }

        // Normalize title to a valid translation key
        $normalizedKey = $this->normalizeTranslationKey($title);
        \Log::info('Normalized key: "' . $normalizedKey . '"');

        // Try menu-specific translations first (scoped to menu only)
        $fullKey = 'menu.' . $normalizedKey;
        \Log::info('Full translation key: "' . $fullKey . '"');

        $menuTranslated = __($fullKey);
        \Log::info('Translation result: "' . $menuTranslated . '"');
        \Log::info('Keys match? ' . ($menuTranslated === $fullKey ? 'YES (not found)' : 'NO (found)'));

        if ($menuTranslated !== $fullKey) {
            \Log::info('Using translated: "' . $menuTranslated . '"');
            return $menuTranslated;
        }

        // Return original title if no menu translation found
        \Log::info('No translation found, returning original');
        return $title;
    }

    /**
     * Normalize title to a valid translation key
     */
    private function normalizeTranslationKey(string $title): string
    {
        // Clean up the title to make a readable key
        $key = strtolower(trim($title));
        \Log::info('Step 1 - lowercase/trim: "' . $key . '"');

        // Replace common patterns
        $replacements = [
            ' & ' => '_and_',
            '&' => '_and_',
            ' ' => '_',
            '-' => '_',
            '/' => '_or_',
            '!' => '',
            '?' => '',
            '.' => '',
            ',' => '',
        ];

        $key = str_replace(array_keys($replacements), array_values($replacements), $key);
        \Log::info('Step 2 - replacements: "' . $key . '"');

        // Remove any remaining special characters and clean up multiple underscores
        $key = preg_replace('/[^a-z0-9_]/', '', $key);
        \Log::info('Step 3 - remove special chars: "' . $key . '"');

        $key = preg_replace('/_+/', '_', $key); // Replace multiple underscores with single
        \Log::info('Step 4 - clean underscores: "' . $key . '"');

        $finalKey = trim($key, '_'); // Remove leading/trailing underscores
        \Log::info('Step 5 - final key: "' . $finalKey . '"');

        return $finalKey;
    }
}