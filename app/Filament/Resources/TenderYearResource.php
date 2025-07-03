<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenderYearResource\Pages;
use App\Models\TenderYear;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class TenderYearResource extends BaseTaxonomyResource
{
    protected static ?string $model = TenderYear::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Tenders';
    protected static ?int $navigationSort = 40;

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
            'index' => Pages\ListTenderYears::route('/'),
            'create' => Pages\CreateTenderYear::route('/create'),
            'edit' => Pages\EditTenderYear::route('/{record}/edit'),
        ];
    }
}
