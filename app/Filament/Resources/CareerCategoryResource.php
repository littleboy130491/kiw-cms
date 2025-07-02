<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerCategoryResource\Pages;
use App\Models\CareerCategory;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class CareerCategoryResource extends BaseTaxonomyResource
{
    protected static ?string $model = CareerCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'People';
    protected static ?int $navigationSort = 30;

    protected static function hiddenFields(): array
    {
        return [
            'template',
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
            'index' => Pages\ListCareerCategories::route('/'),
            'create' => Pages\CreateCareerCategory::route('/create'),
            'edit' => Pages\EditCareerCategory::route('/{record}/edit'),
        ];
    }
}
