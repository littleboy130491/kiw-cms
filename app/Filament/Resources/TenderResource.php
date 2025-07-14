<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenderResource\Pages;
use App\Models\Tender;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Littleboy130491\Sumimasen\Filament\Abstracts\BaseContentResource;

class TenderResource extends BaseContentResource
{
    protected static ?string $model = Tender::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationGroup = 'Tenders';
    protected static ?int $navigationSort = 0;

    protected static function additionalTranslatableFormFields(?string $locale): array
    {

        $defaultSpecification = [
            'Tanggal Pembuatan Paket',
            'Tahun Anggaran',
            'Unit Kerja',
            'Bidang / Sub Bidang',
            'Uraian Pemilihan Penyedia',
            'Lokasi Pekerjaan',
            'Jenis Pekerjaan',
            'Metode Pemilihan Penyedia',
            'Kualifikasi',
            'Metode Evaluasi',
            'Alamat',
            'Email',
            'Telepon',
        ];


        $defaultItems = collect($defaultSpecification)->map(fn($item) => [
            'name' => $item,
        ])->toArray();

        return [
            Repeater::make('specification')
                ->schema([
                    TextInput::make('name')->nullable(),
                    TextInput::make('value')->nullable(),
                ])
                ->default($defaultItems)
                ->columns(2)
                ->columnSpanFull(),

            Repeater::make('process')
                ->columns(2)
                ->schema([
                    TextInput::make('name')->nullable()
                        ->columnSpan(1),
                    TextInput::make('date')->nullable()
                        ->columnSpan(1),

                ])
                ->columnSpanFull()
        ];

    }

    protected static function hiddenFields(): array
    {
        return [
            'excerpt',
            'template',
            'custom_fields',
            'featured_image'
        ];
    }

    protected static function formRelationshipsFields(): array
    {
        return [
            ...static::formTaxonomyRelationshipField('tenderYear', multiple: false),
            ...static::formTaxonomyRelationshipField('tenderStatus', multiple: false),
            ...static::formTaxonomyRelationshipField('tenderLocation', multiple: false),
        ];
    }

    protected static function getRelationshipsToReplicate(): array
    {
        return ['tenderYear', 'tenderStatus', 'tenderLocation'];
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
            'index' => Pages\ListTenders::route('/'),
            'create' => Pages\CreateTender::route('/create'),
            'edit' => Pages\EditTender::route('/{record}/edit'),
        ];
    }
}
