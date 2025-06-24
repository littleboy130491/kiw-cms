<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementYearResource\Pages;
use App\Filament\Resources\AchievementYearResource\RelationManagers;
use App\Models\AchievementYear;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class AchievementYearResource extends BaseTaxonomyResource
{
    protected static ?string $model = AchievementYear::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Achievements';
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
            'index' => Pages\ListAchievementYears::route('/'),
            'create' => Pages\CreateAchievementYear::route('/create'),
            'edit' => Pages\EditAchievementYear::route('/{record}/edit'),
        ];
    }
}
