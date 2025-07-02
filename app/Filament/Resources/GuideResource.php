<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuideResource\Pages;

use App\Models\Guide;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class GuideResource extends BaseContentResource
{
    protected static ?string $model = Guide::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Documents';
    protected static ?int $navigationSort = 20;

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
            'content',
            'featured_image',
        ];
    }
    protected static function additionalTranslatableFormFields(?string $locale): array
    {

        return [
            CuratorPicker::make('file')
                ->acceptedFileTypes(['application/pdf'])
                ->columnSpanFull(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuides::route('/'),
            'create' => Pages\CreateGuide::route('/create'),
            'edit' => Pages\EditGuide::route('/{record}/edit'),
        ];
    }
}
