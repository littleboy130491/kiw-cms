<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementYearResource\Pages;
use App\Models\AchievementYear;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseTaxonomyResource;

class AchievementYearResource extends BaseTaxonomyResource
{
    protected static ?string $model = AchievementYear::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Achievements';
    protected static ?int $navigationSort = 30;

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
            'index' => Pages\ListAchievementYears::route('/'),
            'create' => Pages\CreateAchievementYear::route('/create'),
            'edit' => Pages\EditAchievementYear::route('/{record}/edit'),
        ];
    }
}
