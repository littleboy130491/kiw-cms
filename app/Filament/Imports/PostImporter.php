<?php

namespace App\Filament\Imports;

use App\Models\Post;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PostImporter extends Importer
{
    protected static ?string $model = Post::class;

    public static function getColumns(): array
    {
        $columns = [
            ImportColumn::make('id')
                ->rules(['integer']),
            
            ImportColumn::make('author')
                ->label('Author (Name or Email)')
                ->fillRecordUsing(function (Post $record, $state) {
                    if (empty($state)) return;
                    
                    // Try to find user by email or name
                    $user = \App\Models\User::where('email', $state)
                        ->orWhere('name', $state)
                        ->first();
                    
                    if ($user) {
                        $record->author_id = $user->id;
                    }
                }),
            
            ImportColumn::make('status')
                ->rules(['required']),
            
            ImportColumn::make('featured')
                ->boolean()
                ->rules(['boolean']),
            
            ImportColumn::make('menu_order')
                ->numeric()
                ->rules(['integer']),
            
            ImportColumn::make('published_at')
                ->rules(['date']),
            
            ImportColumn::make('created_at')
                ->rules(['date']),
            
            ImportColumn::make('updated_at')
                ->rules(['date']),

            // Featured Image
            ImportColumn::make('featured_image')
                ->label('Featured Image (URL or ID)')
                ->fillRecordUsing(function (Post $record, $state) {
                    if (empty($state)) return;
                    
                    // Handle both ID and URL
                    if (is_numeric($state)) {
                        $record->featured_image = (int) $state;
                    } else if (filter_var($state, FILTER_VALIDATE_URL)) {
                        $media = \Awcodes\Curator\Models\Media::get()
                            ->first(fn($item) => $item->url === $state);
                        
                        $record->featured_image = $media?->id;
                    }
                }),

            // Categories (comma-separated)
            ImportColumn::make('categories')
                ->label('Categories (comma-separated names)')
                ->fillRecordUsing(function (Post $record, $state) {
                    if (empty($state)) return;
                    
                    $categoryNames = array_map('trim', explode(',', $state));
                    $categoryIds = [];
                    
                    foreach ($categoryNames as $name) {
                        if (!empty($name)) {
                            $category = \Littleboy130491\Sumimasen\Models\Category::firstOrCreate([
                                'name' => $name,
                                'slug' => \Illuminate\Support\Str::slug($name)
                            ]);
                            $categoryIds[] = $category->id;
                        }
                    }
                    
                    // Store for later syncing after save
                    $record->_import_categories = $categoryIds;
                }),

            // Tags (comma-separated)
            ImportColumn::make('tags')
                ->label('Tags (comma-separated names)')
                ->fillRecordUsing(function (Post $record, $state) {
                    if (empty($state)) return;
                    
                    $tagNames = array_map('trim', explode(',', $state));
                    $tagIds = [];
                    
                    foreach ($tagNames as $name) {
                        if (!empty($name)) {
                            $tag = \Littleboy130491\Sumimasen\Models\Tag::firstOrCreate([
                                'name' => $name,
                                'slug' => \Illuminate\Support\Str::slug($name)
                            ]);
                            $tagIds[] = $tag->id;
                        }
                    }
                    
                    // Store for later syncing after save
                    $record->_import_tags = $tagIds;
                }),

            // Custom fields as JSON
            ImportColumn::make('custom_fields')
                ->label('Custom Fields (JSON)')
                ->fillRecordUsing(function (Post $record, $state) {
                    if (empty($state)) {
                        $record->custom_fields = null;
                        return;
                    }

                    $decoded = json_decode($state, true);
                    $record->custom_fields = is_array($decoded) ? $decoded : [];
                }),

            // Gallery as JSON array
            ImportColumn::make('gallery')
                ->label('Gallery (JSON array of IDs)')
                ->fillRecordUsing(function (Post $record, $state) {
                    if (empty($state)) {
                        $record->gallery = null;
                        return;
                    }

                    $decoded = json_decode($state, true);
                    $record->gallery = is_array($decoded) ? $decoded : [];
                }),
        ];

        // Add translatable columns dynamically
        $languages = config('cms.language_available', []);
        $translatableFields = ['title', 'slug', 'excerpt', 'content'];

        foreach ($translatableFields as $field) {
            foreach ($languages as $langCode => $langName) {
                $columns[] = ImportColumn::make("{$field}_{$langCode}")
                    ->label(ucfirst($field) . " ({$langName})")
                    ->fillRecordUsing(function (Post $record, $state) use ($field, $langCode) {
                        if (!empty($state)) {
                            $record->setTranslation($field, $langCode, $state);
                        }
                    });
            }
        }

        return $columns;
    }

    public function resolveRecord(): ?Post
    {
        try {
            \Log::info('Post import resolveRecord', ['data' => $this->data]);
            
            // Find existing record by ID or create new one
            if ($this->data['id'] ?? null) {
                return Post::find($this->data['id']) ?? new Post();
            }
            
            return new Post();
        } catch (\Exception $e) {
            \Log::error('Post import resolveRecord error', [
                'error' => $e->getMessage(),
                'data' => $this->data
            ]);
            throw $e;
        }
    }

    protected function afterSave(): void
    {
        try {
            $record = $this->getRecord();
            
            // Sync categories if they were imported
            if (isset($record->_import_categories)) {
                $record->categories()->sync($record->_import_categories);
                unset($record->_import_categories);
            }
            
            // Sync tags if they were imported
            if (isset($record->_import_tags)) {
                $record->tags()->sync($record->_import_tags);
                unset($record->_import_tags);
            }
        } catch (\Exception $e) {
            \Log::error('Post import afterSave error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your post import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}