<?php

namespace App\Filament\Resources\BuildingCategoryResource\Pages;

use App\Filament\Resources\BuildingCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBuildingCategory extends EditRecord
{
    protected static string $resource = BuildingCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
