<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Littleboy130491\Sumimasen\Filament\Resources\PostResource as BasePostResource;
use Filament\Forms\Components\Textarea;
class PostResource extends BasePostResource
{
    protected static ?string $model = Post::class;

    protected static function additionalNonTranslatableFormFields(): array
    {

        return [
            Textarea::make('gallery')
                ->label(__('Gallery'))
                ->columnSpanFull()
                ->required()
                ->maxLength(500)
                ->helperText(__('A short summary of the post, used in listings and previews.')),
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
