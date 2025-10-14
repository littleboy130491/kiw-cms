<?php

namespace App\Support;

use Filament\Forms\Components\Builder as FormsBuilder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Toggle;

class CustomContentBlocks
{
    /**
     * Get all custom blocks to be added to resources using HasContentBlocks trait
     */
    public static function getCustomBlocks(): array
    {
        return [
            static::getHotspotLahanIndustriBlock(),
            static::getTabProfilPerusahaanBlock(),
        ];
    }

    private static function getHotspotLahanIndustriBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('hotspot-lahan-industri')
            ->label('Hotspot Lahan Industri')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                TextInput::make('title'),
                TextInput::make('luas'),
                TextInput::make('top')
                    ->numeric(),
                TextInput::make('left')
                    ->numeric(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('note')
                    ->columnSpanFull(),
                CuratorPicker::make('image')
                    ->label('Image')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                Toggle::make('hide')
                    ->label('Hide Block')
                    ->helperText('Hide this block from display')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    private static function getTabProfilPerusahaanBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('tab-profil-perusahaan')
            ->label('Tab Profil Perusahaan')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                TextInput::make('tab_title'),
                TextInput::make('content_title'),
                TextInput::make('content_subtitle'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('cta'),
                TextInput::make('cta_label'),
                Textarea::make('note')
                    ->columnSpanFull(),
                CuratorPicker::make('image')
                    ->label('Image')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                CuratorPicker::make('logo')
                    ->label('Logo')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                Toggle::make('hide')
                    ->label('Hide Block')
                    ->helperText('Hide this block from display')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

}