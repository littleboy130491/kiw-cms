<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms\Components\TextInput;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class CareerResource extends BaseContentResource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'People';
    protected static ?int $navigationSort = 20;

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
        ];
    }

    protected static function additionalNonTranslatableFormFields(): array
    {

        return [
            TextInput::make('cta')
                ->label('Call to Action')
                ->nullable(),
        ];
    }

    protected static function formRelationshipsFields(): array
    {
        return [
            ...static::formTaxonomyRelationshipField('careerCategories', tableName: 'career_categories'),
        ];
    }

    protected static function getRelationshipsToReplicate(): array
    {
        return ['careerCategories'];
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
