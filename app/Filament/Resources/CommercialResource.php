<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommercialResource\Pages;
use App\Models\Commercial;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class CommercialResource extends BaseContentResource
{
    protected static ?string $model = Commercial::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?string $navigationGroup = 'Services';
    protected static ?int $navigationSort = 30;

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
            'featured_image',
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
            TextInput::make('hero_title')
                ->nullable(),
            TextInput::make('cta_label')
                ->nullable(),
            Repeater::make('specification')
                ->schema([
                    TextInput::make('name')->nullable(),
                    TextInput::make('value')->nullable(),

                ])
                ->default($defaultItems)
                ->columns(2)
                ->columnSpanFull(),
        ];
    }

    protected static function additionalNonTranslatableFormFields(): array
    {

        return [
            TextInput::make('whatsapp')
                ->nullable()
                ->label('WhatsApp')
                ->columnSpanFull(),
            // TextInput::make('cta')
            //     ->nullable()
            //     ->label('Call to Action'),
            CuratorPicker::make('gallery')
                ->multiple()
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'])
                ->columnSpanFull(),
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
            'index' => Pages\ListCommercials::route('/'),
            'create' => Pages\CreateCommercial::route('/create'),
            'edit' => Pages\EditCommercial::route('/{record}/edit'),
        ];
    }
}
