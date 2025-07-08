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
        $fields = [];

        $specificationList = [
            'tanggal' => 'Tanggal Pembuatan Paket',
            'tahun_anggaran' => 'Tahun Anggaran',
            'unit_kerja' => 'Unit Kerja',
            'bidang' => 'Bidang / Sub Bidang',
            'uraian' => 'Uraian Pemilihan Penyedia',
            'lokasi' => 'Lokasi Pekerjaan',
            'jenis' => 'Jenis Pekerjaan',
            'metode_pemilihan' => 'Metode Pemilihan Penyedia',
            'kualifikasi' => 'Kualifikasi',
            'metode_evaluasi' => 'Metode Evaluasi',
            'alamat' => 'Alamat',
            'email' => 'Email',
            'telepon' => 'Telepon',
        ];


        foreach ($specificationList as $key => $label) {
            $fields[] = TextInput::make('specification.' . $key)
                ->label($label)
                ->nullable()
                ->columnSpan(1);
        }

        $fields[] =
            Repeater::make('process')
                ->columns(2)
                ->schema([
                    TextInput::make('name')->nullable()
                        ->columnSpan(1),
                    TextInput::make('date')->nullable()
                        ->columnSpan(1),

                ])
                ->columnSpanFull();

        return $fields;
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
            ...static::formTaxonomyRelationshipField('tenderYear'),
            ...static::formTaxonomyRelationshipField('tenderStatus'),
            ...static::formTaxonomyRelationshipField('tenderLocation'),
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
