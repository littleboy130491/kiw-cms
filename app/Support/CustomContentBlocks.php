<?php

namespace App\Support;

use Filament\Forms\Components\Builder as FormsBuilder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;

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
            static::getHotspotKoneksiGlobalBlock(),
            static::getSliderHeightBlock(),
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
                // Toggle::make('hide')
                //     ->label('Hide Block')
                //     ->helperText('Hide this block from display')
                //     ->columnSpanFull(),
            ])
            ->columns(2);
    }

    private static function getHotspotKoneksiGlobalBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('hotspot-koneksi-global')
            ->label('Hotspot Koneksi Global')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                TextInput::make('country'),
                TextInput::make('top')
                    ->numeric(),
                TextInput::make('left')
                    ->numeric(),
                TextInput::make(name: 'company'),
                CuratorPicker::make('image')
                    ->label('Flag')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                // Toggle::make('hide')
                //     ->label('Hide Block')
                //     ->helperText('Hide this block from display')
                //     ->columnSpanFull(),
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
                CuratorPicker::make('image')
                    ->label('Image')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                CuratorPicker::make('logo')
                    ->label('Logo')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                // Toggle::make('hide')
                //     ->label('Hide Block')
                //     ->helperText('Hide this block from display')
                //     ->columnSpanFull(),
            ])
            ->columns(2);
    }

    private static function getSliderHeightBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('slider-height')
            ->label('Slider Height')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                Select::make('device')
                    ->options([
                        'mobile' => 'Mobile,',
                        'tablet' => 'Tablet,',
                        'desktop' => 'Desktop,'
                    ]),
                Select::make('unit')
                    ->options([
                        'vh' => 'vh,',
                        'px' => 'px,',
                    ]),
                TextInput::make('value'),
                // Toggle::make('hide')
                //     ->label('Hide Block')
                //     ->helperText('Hide this block from display')
                //     ->columnSpanFull(),
            ])
            ->columns(2);
    }

    private static function getSliderWithCounterBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('slider-with-counter')
            ->label('Slider with Counter')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                TextInput::make('title'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('cta'),
                TextInput::make('cta_label'),
                TextInput::make(name: 'video')
                    ->label('Background video')
                    ->columnSpanFull(),
                CuratorPicker::make('image')
                    ->label('Background image')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                CuratorPicker::make('logo')
                    ->label('Content image')
                    ->acceptedFileTypes(['image/*'])
                    ->helperText('Accepted file types: image only'),
                Toggle::make('filter')
                    ->label('Make content image white?')
                    ->columnSpanFull(),
                TextInput::make('counter_title')
                    ->columnSpanFull(),
                Repeater::make('counter_items')
                    ->label('Counter Items')
                    ->schema([
                        TextInput::make('label'),
                        TextInput::make('number'),
                        TextInput::make('prefix'),
                        TextInput::make('suffix'),
                    ])
                    ->reorderable(),
                // Toggle::make('hide')
                //     ->label('Hide Block')
                //     ->helperText('Hide this block from display')
                //     ->columnSpanFull(),
            ])
            ->columns(2);
    }

}