<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BuildingResource\Pages;
use App\Models\Building;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class BuildingResource extends BaseContentResource
{
    protected static ?string $model = Building::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Services';
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
        $defaultSpecification = [
            'Luas Bangunan',
            'Tinggi Bangunan',
            'Luas Pintu',
            'Tinggi Pintu',
            'Pondasi',
            'Kekuatan Lantai',
            'Tembok',
            'Atap',
            'Listrik',
            'Air',
        ];

        $defaultItems = collect($defaultSpecification)->map(fn($item) => [
            'name' => $item,
        ])->toArray();

        return [
            Repeater::make('specification')
                ->schema([
                    TextInput::make('name')->nullable(),
                    TextInput::make('value')->nullable(),

                ])
                ->columns(2)
                ->default($defaultItems)
                ->columnSpanFull(),
        ];
    }

    protected static function additionalNonTranslatableFormFields(): array
    {

        return [
            TextInput::make('whatsapp')
                ->nullable()
                ->label('WhatsApp'),
            TextInput::make('cta')
                ->nullable()
                ->label('Call to Action'),
            CuratorPicker::make('gallery')
                ->multiple()
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'])
                ->columnSpanFull(),
        ];
    }

    protected static function formRelationshipsFields(): array
    {
        return [
            ...static::formTaxonomyRelationshipField('buildingCategories', tableName: 'building_categories', multiple: false),
        ];
    }

    protected static function getRelationshipsToReplicate(): array
    {
        return ['buildingCategories'];
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
