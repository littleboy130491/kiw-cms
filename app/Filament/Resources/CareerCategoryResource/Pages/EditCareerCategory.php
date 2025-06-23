<?php

namespace App\Filament\Resources\CareerCategoryResource\Pages;

use App\Filament\Resources\CareerCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareerCategory extends EditRecord
{
    protected static string $resource = CareerCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
