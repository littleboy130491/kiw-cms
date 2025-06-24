<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerCategoryResource\Pages;
use App\Filament\Resources\CareerCategoryResource\RelationManagers;
use App\Models\CareerCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class CareerCategoryResource extends BaseTaxonomyResource
{
    protected static ?string $model = CareerCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'People';
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCareerCategories::route('/'),
            'create' => Pages\CreateCareerCategory::route('/create'),
            'edit' => Pages\EditCareerCategory::route('/{record}/edit'),
        ];
    }
}
