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
            static::getCustomBlock(),
            static::getAnotherCustomBlock(),
            static::getTestimonialBlock(),
            // Add more custom blocks here
        ];
    }

    private static function getCustomBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('custom')
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

    private static function getAnotherCustomBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('another_custom')
            ->label('Another Custom Block')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->columnSpanFull(),
                TextInput::make('another_field')
                    ->label('Another Field'),
                TextInput::make('extra_field')
                    ->label('Extra Field'),
            ])
            ->columns(2);
    }

    private static function getTestimonialBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('testimonial')
            ->label('Testimonial')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->columnSpanFull(),
                TextInput::make('author_name')
                    ->label('Author Name'),
                TextInput::make('author_title')
                    ->label('Author Title'),
                Textarea::make('quote')
                    ->label('Testimonial Quote')
                    ->columnSpanFull(),
                CuratorPicker::make('author_image')
                    ->label('Author Photo')
                    ->acceptedFileTypes(['image/*'])
                    ->preserveFilenames(),
            ])
            ->columns(2);
    }
}