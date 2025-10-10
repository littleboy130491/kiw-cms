<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Documents';
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Gallery Details')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('For labeling purpose, should be unique')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Select::make('type')
                        ->options([
                            'images' => 'Images',
                            'videos' => 'Videos',
                        ])
                        ->required()
                        ->default('images'),

                    Forms\Components\Select::make('month')
                        ->options([
                            1 => 'January',
                            2 => 'February',
                            3 => 'March',
                            4 => 'April',
                            5 => 'May',
                            6 => 'June',
                            7 => 'July',
                            8 => 'August',
                            9 => 'September',
                            10 => 'October',
                            11 => 'November',
                            12 => 'December',
                        ])
                        ->required()
                        ->default(now()->month),

                    Forms\Components\TextInput::make('year')
                        ->numeric()
                        ->required()
                        ->default(now()->year)
                        ->minValue(2000)
                        ->maxValue(2100),

                    Forms\Components\Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                        ])
                        ->required()
                        ->default('draft'),

                ])->columns(2),

            Forms\Components\Section::make('Media Files')
                ->schema([
                    CuratorPicker::make('media')
                        ->label('Gallery Files')
                        ->multiple()
                        ->helperText('Upload and arrange your gallery files')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'images',
                        'success' => 'videos',
                    ]),

                Tables\Columns\TextColumn::make('date_display')
                    ->label('Date')
                    ->sortable(['year', 'month']),

                Tables\Columns\TextColumn::make('media_count')
                    ->label('Files')
                    ->getStateUsing(fn($record) => is_array($record->media) ? count($record->media) : 0),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ]),

                Tables\Columns\TextColumn::make('menu_order')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'images' => 'Images',
                        'videos' => 'Videos',
                    ]),
                Tables\Filters\SelectFilter::make('year')
                    ->options(fn() => Gallery::distinct()->pluck('year', 'year')->sort()->reverse()),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}