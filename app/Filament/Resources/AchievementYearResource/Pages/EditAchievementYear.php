<?php

namespace App\Filament\Resources\AchievementYearResource\Pages;

use App\Filament\Resources\AchievementYearResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAchievementYear extends EditRecord
{
    protected static string $resource = AchievementYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
