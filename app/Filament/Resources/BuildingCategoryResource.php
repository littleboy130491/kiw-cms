<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BuildingCategoryResource\Pages;
use App\Filament\Resources\BuildingCategoryResource\RelationManagers;
use App\Models\BuildingCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class BuildingCategoryResource extends BaseTaxonomyResource
{
    protected static ?string $model = BuildingCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 20;

    protected static function additionalTranslatableFormFields(?string $locale): array
    {

        return [];
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
