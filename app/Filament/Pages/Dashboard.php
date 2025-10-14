<?php

namespace App\Filament\Pages;

use Filament\Widgets;

class Dashboard extends \Filament\Pages\Dashboard
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-panels::pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }

    public function getWidgets(): array
    {
        return [
            Widgets\AccountWidget::class,
        ];
    }
}