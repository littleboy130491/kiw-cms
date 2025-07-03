<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenderLocationResource\Pages;
use App\Models\TenderLocation;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class TenderLocationResource extends BaseTaxonomyResource
{
    protected static ?string $model = TenderLocation::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Tenders';
    protected static ?int $navigationSort = 50;

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
            'index' => Pages\ListTenderLocations::route('/'),
            'create' => Pages\CreateTenderLocation::route('/create'),
            'edit' => Pages\EditTenderLocation::route('/{record}/edit'),
        ];
    }
}
