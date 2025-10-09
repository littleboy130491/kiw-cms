<?php

namespace App\Providers;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder as FormsBuilder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\ServiceProvider;

class ContentBlocksServiceProviderDummy extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register custom content blocks
     * This method is called by the HasContentBlocks trait to add custom blocks
     */
    public function registerCustomContentBlocks(): array
    {
        return [
            $this->getCustomTestimonialBlock(),
            $this->getCustomPricingBlock(),
            // Add more custom blocks here
        ];
    }

    /**
     * Example: Custom Testimonial Block
     */
    private function getCustomTestimonialBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('testimonial')
            ->label('Testimonial')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                TextInput::make('customer_name')
                    ->label('Customer Name')
                    ->required(),
                TextInput::make('customer_title')
                    ->label('Customer Title'),
                TiptapEditor::make('testimonial')
                    ->label('Testimonial Content')
                    ->profile('simple')
                    ->columnSpanFull(),
                CuratorPicker::make('customer_image')
                    ->label('Customer Image')
                    ->acceptedFileTypes(['image/*'])
                    ->preserveFilenames(),
                TextInput::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5),
            ])
            ->columns(2);
    }

    /**
     * Example: Custom Pricing Block
     */
    private function getCustomPricingBlock(): FormsBuilder\Block
    {
        return FormsBuilder\Block::make('pricing')
            ->label('Pricing Table')
            ->schema([
                TextInput::make('block_id')
                    ->label('Block ID')
                    ->helperText('Identifier for the block')
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->label('Section Title')
                    ->required(),
                TiptapEditor::make('description')
                    ->label('Section Description')
                    ->profile('simple')
                    ->columnSpanFull(),
                // You can add repeaters for pricing plans here
                TextInput::make('currency')
                    ->label('Currency Symbol')
                    ->default('$'),
            ])
            ->columns(2);
    }
}