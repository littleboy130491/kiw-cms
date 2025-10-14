<?php

namespace App\Support;

use Filament\Forms\Components\Builder as FormsBuilder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class CustomContentBlocks
{
    /**
     * Get all custom blocks to be added to resources using HasContentBlocks trait
     */
    public static function getCustomBlocks(): array
    {
        return [
            static::getHotspotLahanIndustriBlock(),
            // Add more custom blocks here
        ];
    }

    private static function getHotspotLahanIndustriBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('hotspot-lahan-industri')
            ->label('Custom Block')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                TextInput::make('custom_field')
                    ->label('Custom Field'),
                Textarea::make('custom_description')
                    ->label('Custom Description')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

}