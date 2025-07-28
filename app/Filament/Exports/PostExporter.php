<?php

namespace App\Filament\Exports;

use App\Models\Post;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PostExporter extends Exporter
{
    protected static ?string $model = Post::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('author.name')
                ->label('Author'),
            ExportColumn::make('status')
                ->formatStateUsing(fn($state) => $state?->value ?? $state),
            ExportColumn::make('featured')
                ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
            ExportColumn::make('menu_order'),
            ExportColumn::make('published_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),

            // Translatable columns for each language
            ExportColumn::make('title.en')
                ->label('Title (English)')
                ->formatStateUsing(fn($record) => $record->getTranslation('title', 'en')),
            ExportColumn::make('title.id')
                ->label('Title (Indonesian)')
                ->formatStateUsing(fn($record) => $record->getTranslation('title', 'id')),
            ExportColumn::make('title.zh-cn')
                ->label('Title (Chinese)')
                ->formatStateUsing(fn($record) => $record->getTranslation('title', 'zh-cn')),
            ExportColumn::make('title.ko')
                ->label('Title (Korean)')
                ->formatStateUsing(fn($record) => $record->getTranslation('title', 'ko')),

            ExportColumn::make('slug.en')
                ->label('Slug (English)')
                ->formatStateUsing(fn($record) => $record->getTranslation('slug', 'en')),
            ExportColumn::make('slug.id')
                ->label('Slug (Indonesian)')
                ->formatStateUsing(fn($record) => $record->getTranslation('slug', 'id')),
            ExportColumn::make('slug.zh-cn')
                ->label('Slug (Chinese)')
                ->formatStateUsing(fn($record) => $record->getTranslation('slug', 'zh-cn')),
            ExportColumn::make('slug.ko')
                ->label('Slug (Korean)')
                ->formatStateUsing(fn($record) => $record->getTranslation('slug', 'ko')),

            ExportColumn::make('excerpt.en')
                ->label('Excerpt (English)')
                ->formatStateUsing(fn($record) => $record->getTranslation('excerpt', 'en')),
            ExportColumn::make('excerpt.id')
                ->label('Excerpt (Indonesian)')
                ->formatStateUsing(fn($record) => $record->getTranslation('excerpt', 'id')),
            ExportColumn::make('excerpt.zh-cn')
                ->label('Excerpt (Chinese)')
                ->formatStateUsing(fn($record) => $record->getTranslation('excerpt', 'zh-cn')),
            ExportColumn::make('excerpt.ko')
                ->label('Excerpt (Korean)')
                ->formatStateUsing(fn($record) => $record->getTranslation('excerpt', 'ko')),

            ExportColumn::make('content.en')
                ->label('Content (English)')
                ->formatStateUsing(fn($record) => $record->getTranslation('content', 'en')),
            ExportColumn::make('content.id')
                ->label('Content (Indonesian)')
                ->formatStateUsing(fn($record) => $record->getTranslation('content', 'id')),
            ExportColumn::make('content.zh-cn')
                ->label('Content (Chinese)')
                ->formatStateUsing(fn($record) => $record->getTranslation('content', 'zh-cn')),
            ExportColumn::make('content.ko')
                ->label('Content (Korean)')
                ->formatStateUsing(fn($record) => $record->getTranslation('content', 'ko')),

            // Featured Image
            ExportColumn::make('featuredImage.url')
                ->label('Featured Image'),

            // Relationships
            ExportColumn::make('categories.title')
                ->label('Categories')
                ->formatStateUsing(fn($record) => $record->categories->pluck('title')->join(', ')),
            ExportColumn::make('tags.title')
                ->label('Tags')
                ->formatStateUsing(fn($record) => $record->tags->pluck('title')->join(', ')),

            // Custom fields as JSON
            ExportColumn::make('custom_fields')
                ->listAsJson(),

            // Gallery URLs
            ExportColumn::make('gallery')
                ->label('Gallery URLs')
                ->getStateUsing(function ($record) {
                    $galleryIds = $record->gallery;

                    if (!$galleryIds || !is_array($galleryIds)) {
                        return '';
                    }

                    $urls = \Awcodes\Curator\Models\Media::whereIn('id', $galleryIds)
                        ->get()
                        ->map(fn($media) => $media->url)
                        ->filter()
                        ->toArray();

                    return json_encode($urls);
                }),

        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your post export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}