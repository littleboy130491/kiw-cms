<?php

namespace App\Filament\Resources\PostResource\Pages;

use Littleboy130491\Sumimasen\Filament\Exports\PostExporter;
use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->exporter(PostExporter::class)
                ->fileDisk('local'),
            Actions\CreateAction::make(),
        ];
    }
}
