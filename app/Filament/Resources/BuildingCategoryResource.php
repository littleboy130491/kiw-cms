<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BuildingCategoryResource\Pages;
use App\Models\BuildingCategory;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class BuildingCategoryResource extends BaseTaxonomyResource
{
    protected static ?string $model = BuildingCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 20;

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
            'index' => Pages\ListBuildingCategories::route('/'),
            'create' => Pages\CreateBuildingCategory::route('/create'),
            'edit' => Pages\EditBuildingCategory::route('/{record}/edit'),
        ];
    }
}
