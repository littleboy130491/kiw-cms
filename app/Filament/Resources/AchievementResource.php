<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;
use Filament\Forms\Components\TextInput;

class AchievementResource extends BaseContentResource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Achievements';
    protected static ?int $navigationSort = 0;

    protected static function additionalTranslatableFormFields(?string $locale): array
    {
        return [
            TextInput::make('giver')
                ->nullable()
                ->columnSpanFull(),
        ];
    }

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
            'content',
        ];
    }

    protected static function formRelationshipsFields(): array
    {
        return [
            ...static::formTaxonomyRelationshipField('achievementType', multiple: false),
            ...static::formTaxonomyRelationshipField('achievementYear', multiple: false),
        ];
    }

    protected static function getRelationshipsToReplicate(): array
    {
        return ['achievementType', 'achievementYear'];
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
