<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagementResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Management;

use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class ManagementResource extends BaseContentResource
{
    protected static ?string $model = Management::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'People';
    protected static ?int $navigationSort = 0;

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
        ];
    }

    protected static function additionalTranslatableFormFields(?string $locale): array
    {

        return [
            TextInput::make('position')->nullable(),
        ];
    }

    protected static function additionalNonTranslatableFormFields(): array
    {

        return [
            Select::make('level')
                ->options([
                    'commissioner' => 'Commissioner',
                    'bod'   => 'Board of Directors',
                    'heads' => 'Heads'
                ])
                ->required(),
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
            'index' => Pages\ListManagement::route('/'),
            'create' => Pages\CreateManagement::route('/create'),
            'edit' => Pages\EditManagement::route('/{record}/edit'),
        ];
    }
}
