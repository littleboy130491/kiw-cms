<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Littleboy130491\Sumimasen\Filament\Resources\PostResource as BasePostResource;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class PostResource extends BasePostResource
{
    protected static ?string $model = Post::class;

    protected static function additionalNonTranslatableFormFields(): array
    {

        return [
            CuratorPicker::make('gallery')
                ->multiple()
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml']),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
