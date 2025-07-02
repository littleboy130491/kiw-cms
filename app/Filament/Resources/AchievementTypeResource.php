<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementTypeResource\Pages;
use App\Models\AchievementType;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class AchievementTypeResource extends BaseTaxonomyResource
{
    protected static ?string $model = AchievementType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Achievements';
    protected static ?int $navigationSort = 20;

    protected static function hiddenFields(): array
    {
        return [
            'template',
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
            'index' => Pages\ListAchievementTypes::route('/'),
            'create' => Pages\CreateAchievementType::route('/create'),
            'edit' => Pages\EditAchievementType::route('/{record}/edit'),
        ];
    }
}
