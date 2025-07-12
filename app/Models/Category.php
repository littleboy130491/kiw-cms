<?php

namespace App\Models;

use Littleboy130491\Sumimasen\Models\Category as BaseCategory;
use Datlechin\FilamentMenuBuilder\Concerns\HasMenuPanel;
use Datlechin\FilamentMenuBuilder\Contracts\MenuPanelable;

class Category extends BaseCategory implements MenuPanelable
{
    use HasMenuPanel;

    public function getMenuPanelTitleColumn(): string
    {
        return 'title';
    }

    public function getMenuPanelUrlUsing(): callable
    {
        $content_model_slug = config('cms.content_models.categories.slug', 'categories');
        $locale = app()->getLocale();
        return fn(self $model) => '/' . $locale . '/' . $content_model_slug . '/' . $model->slug;
    }
}
