<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenderStatusResource\Pages;
use App\Models\TenderStatus;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class TenderStatusResource extends BaseTaxonomyResource
{
    protected static ?string $model = TenderStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Tenders';
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
            'index' => Pages\ListTenderStatuses::route('/'),
            'create' => Pages\CreateTenderStatus::route('/create'),
            'edit' => Pages\EditTenderStatus::route('/{record}/edit'),
        ];
    }
}
