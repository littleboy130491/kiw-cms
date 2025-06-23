<?php

namespace App\Filament\Resources\TenderLocationResource\Pages;

use App\Filament\Resources\TenderLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTenderLocations extends ListRecords
{
    protected static string $resource = TenderLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
