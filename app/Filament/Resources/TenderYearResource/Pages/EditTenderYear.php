<?php

namespace App\Filament\Resources\TenderYearResource\Pages;

use App\Filament\Resources\TenderYearResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenderYear extends EditRecord
{
    protected static string $resource = TenderYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
