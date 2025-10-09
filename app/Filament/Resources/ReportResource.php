<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class ReportResource extends BaseContentResource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Documents';
    protected static ?int $navigationSort = 10;

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
            'content',
        ];
    }
    protected static function additionalTranslatableFormFields(?string $locale): array
    {

        return [
            CuratorPicker::make('file')
                ->acceptedFileTypes(['application/pdf'])
                ->columnSpanFull(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
