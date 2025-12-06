<?php

namespace App\Filament\Resources;

use App\Models\PmbWave;
use App\Models\PmbPeriod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PmbWaveResource extends Resource
{
    protected static ?string $model = PmbWave::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Konfigurasi PMB';
    protected static ?string $navigationLabel = 'Gelombang PMB';
    protected static ?string $modelLabel = 'Gelombang PMB';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Umum')
                ->schema([
                    Forms\Components\Select::make('pmb_period_id')
                        ->label('Periode PMB')
                        ->relationship('period', 'nama_periode')
                        ->searchable()
                        ->required(),

                    Forms\Components\TextInput::make('nama_gelombang')
                        ->label('Nama Gelombang')
                        ->placeholder('Contoh: Gelombang 1')
                        ->required(),
                ])->columns(2),

            Forms\Components\Section::make('Jadwal Pendaftaran')
                ->schema([
                    Forms\Components\DatePicker::make('tanggal_mulai')
                        ->label('Mulai Pendaftaran')
                        ->required(),

                    Forms\Components\DatePicker::make('tanggal_selesai')
                        ->label('Selesai Pendaftaran')
                        ->required(),
                ])->columns(2),

            Forms\Components\Section::make('Pengaturan')
                ->schema([
                    Forms\Components\TextInput::make('biaya_pendaftaran')
                        ->numeric()
                        ->label('Biaya Pendaftaran (Opsional)')
                        ->prefix('Rp')
                        ->nullable(),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Gelombang Aktif')
                        ->inline(false)
                        ->helperText('Hanya satu gelombang yang bisa aktif per periode.'),
                ])->columns(2),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('period.nama_periode')
                    ->label('Periode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_gelombang')
                    ->label('Gelombang')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Mulai')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Selesai')
                    ->date()
                    ->sortable(),

                // Tables\Columns\TextColumn::make('biaya_pendaftaran')
                //     ->label('Biaya')
                //     ->money('IDR')
                //     ->sortable(),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif')
                    ->colors([
                        'success' => fn ($state) => $state === true,
                        'danger'  => fn ($state) => $state === false,
                    ]),
            ])

            ->defaultSort('tanggal_mulai', 'asc')

            ->actions([
                Tables\Actions\EditAction::make(),
            ])

            ->filters([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => PmbWaveResource\Pages\ListPmbWaves::route('/'),
            'create' => PmbWaveResource\Pages\CreatePmbWave::route('/create'),
            'edit'   => PmbWaveResource\Pages\EditPmbWave::route('/{record}/edit'),
        ];
    }
}
