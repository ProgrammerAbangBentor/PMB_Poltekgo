<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PmbPeriodResource\Pages;
use App\Models\PmbPeriod;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class PmbPeriodResource extends Resource
{
    protected static ?string $model = PmbPeriod::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Periode PMB';
    protected static ?string $navigationGroup = 'Konfigurasi PMB';
    protected static ?string $modelLabel = 'Periode PMB';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Periode')
                ->schema([
                    Forms\Components\TextInput::make('nama_periode')
                        ->label('Nama Periode')
                        ->required(),

                    Forms\Components\TextInput::make('tahun')
                        ->label('Tahun')
                        ->numeric()
                        ->required(),
                ])->columns(2),

            Forms\Components\Section::make('Tanggal Pendaftaran')
                ->schema([
                    Forms\Components\DatePicker::make('tanggal_mulai')
                        ->label('Mulai Pendaftaran')
                        ->required(),

                    Forms\Components\DatePicker::make('tanggal_selesai')
                        ->label('Selesai Pendaftaran')
                        ->required(),
                ])->columns(2),

            Forms\Components\Section::make('Status Periode')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Periode Aktif')
                        ->inline(false)
                        ->helperText('Hanya 1 periode yang boleh aktif'),
                ]),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_periode')
                    ->label('Periode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tahun')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Mulai')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Selesai')
                    ->date()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif')
                    ->colors([
                        'success' => fn ($state) => $state === true,
                        'danger'  => fn ($state) => $state === false,
                    ])
            ])
            ->defaultSort('tahun', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPmbPeriods::route('/'),
            'create' => Pages\CreatePmbPeriod::route('/create'),
            'edit'   => Pages\EditPmbPeriod::route('/{record}/edit'),
        ];
    }
}
