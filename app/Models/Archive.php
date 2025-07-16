<?php

namespace App\Models;

use Littleboy130491\Sumimasen\Models\Archive as BaseArchive;
use Datlechin\FilamentMenuBuilder\Concerns\HasMenuPanel;
use Datlechin\FilamentMenuBuilder\Contracts\MenuPanelable;

class Archive extends BaseArchive implements MenuPanelable
{
    use HasMenuPanel;

    public function getMenuPanelTitleColumn(): string
    {
        return 'title';
    }

    public function getMenuPanelUrlUsing(): callable
    {
        $locale = app()->getLocale();

        return fn(self $model) => route('cms.archive.content', [$locale, $model->slug]);
    }
}
