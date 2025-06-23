<?php

namespace App\Filament\Resources\BuildingCategoryResource\Pages;

use App\Filament\Resources\BuildingCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBuildingCategories extends ListRecords
{
    protected static string $resource = BuildingCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
