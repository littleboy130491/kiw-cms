<?php

namespace App\Filament\Resources\TenderYearResource\Pages;

use App\Filament\Resources\TenderYearResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTenderYears extends ListRecords
{
    protected static string $resource = TenderYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
