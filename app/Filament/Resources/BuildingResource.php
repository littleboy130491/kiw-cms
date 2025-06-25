<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BuildingResource\Pages;
use App\Filament\Resources\BuildingResource\RelationManagers;
use App\Models\Building;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class BuildingResource extends BaseContentResource
{
    protected static ?string $model = Building::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 0;

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
            'index' => Pages\ListBuildings::route('/'),
            'create' => Pages\CreateBuilding::route('/create'),
            'edit' => Pages\EditBuilding::route('/{record}/edit'),
        ];
    }
}
