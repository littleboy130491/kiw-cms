<?php

namespace App\Filament\Resources\TenderStatusResource\Pages;

use App\Filament\Resources\TenderStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTenderStatuses extends ListRecords
{
    protected static string $resource = TenderStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
