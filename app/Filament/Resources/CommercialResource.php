<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommercialResource\Pages;
use App\Filament\Resources\CommercialResource\RelationManagers;
use App\Models\Commercial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class CommercialResource extends BaseContentResource
{
    protected static ?string $model = Commercial::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 30;


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
            'index' => Pages\ListCommercials::route('/'),
            'create' => Pages\CreateCommercial::route('/create'),
            'edit' => Pages\EditCommercial::route('/{record}/edit'),
        ];
    }
}
