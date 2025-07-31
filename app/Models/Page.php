<?php

namespace App\Models;

use Littleboy130491\Sumimasen\Models\Page as BasePage;
use Datlechin\FilamentMenuBuilder\Concerns\HasMenuPanel;
use Datlechin\FilamentMenuBuilder\Contracts\MenuPanelable;

class Page extends BasePage implements MenuPanelable
{
    use HasMenuPanel;

    public function getMenuPanelTitleColumn(): string
    {
        return 'title';
    }

    public function getMenuPanelUrlUsing(): callable
    {
        $locale = app()->getLocale();
        return fn(self $model) => route('cms.page', [$locale, $model->slug]);
    }

}
