<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Models\Facility;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;
use Filament\Forms\Components\Select;

class FacilityResource extends BaseContentResource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 40;

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
        ];
    }

    protected static function additionalNonTranslatableFormFields(): array
    {

        return [
            Select::make('facility_category')
                ->options([
                    'utama' => 'Utama',
                    'penunjang' => 'Penunjang',
                ])
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
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
        ];
    }
}
