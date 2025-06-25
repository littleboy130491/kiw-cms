<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementTypeResource\Pages;
use App\Filament\Resources\AchievementTypeResource\RelationManagers;
use App\Models\AchievementType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class AchievementTypeResource extends BaseTaxonomyResource
{
    protected static ?string $model = AchievementType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Achievements';
    protected static ?int $navigationSort = 20;

    protected static function additionalTranslatableFormFields(?string $locale): array
    {

        return [];
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
            'index' => Pages\ListAchievementTypes::route('/'),
            'create' => Pages\CreateAchievementType::route('/create'),
            'edit' => Pages\EditAchievementType::route('/{record}/edit'),
        ];
    }
}
