<?php

namespace App\Filament\Resources\CareerCategoryResource\Pages;

use App\Filament\Resources\CareerCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareerCategories extends ListRecords
{
    protected static string $resource = CareerCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
