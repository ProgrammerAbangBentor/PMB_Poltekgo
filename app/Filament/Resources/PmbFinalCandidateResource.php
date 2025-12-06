<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PmbFinalCandidateResource\Pages;
use App\Models\PmbFinalCandidate;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Notifications\Notification;


class PmbFinalCandidateResource extends Resource
{
    protected static ?string $model = PmbFinalCandidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationGroup = 'PMB';
    protected static ?string $navigationLabel = 'Final PMB';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([

            Forms\Components\Section::make('Data Mahasiswa')
                ->schema([
                    Forms\Components\TextInput::make('nama')->disabled(),
                    Forms\Components\TextInput::make('nik')->disabled(),
                    Forms\Components\TextInput::make('nisn')->disabled(),
                    Forms\Components\TextInput::make('hp')->disabled(),
                    Forms\Components\TextInput::make('email')->disabled(),
                ])->columns(2),

            Forms\Components\Section::make('Pembayaran')
                ->schema([
                    Forms\Components\Toggle::make('biaya_pembangunan_lunas')
                        ->label('Lunas Pembangunan'),

                    Forms\Components\Toggle::make('biaya_pkkbm_lunas')
                        ->label('Lunas PKKBM'),

                    Forms\Components\Toggle::make('biaya_spp_lunas')
                        ->label('Lunas SPP'),

                    Forms\Components\Toggle::make('biaya_praktikum_lunas')
                        ->label('Lunas Praktikum'),
                ])->columns(2),

            Forms\Components\Section::make('Status Sinkronisasi')
                ->schema([
                    Forms\Components\Toggle::make('is_ready_to_sync')
                        ->label('Siap Kirim ke SAKTI')
                        ->default(true),

                    Forms\Components\DateTimePicker::make('synced_to_sakti_at')
                        ->label('Terkirim Pada')
                        ->disabled(),
                ]),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('program.nama_program')
                    ->label('Prodi'),

                IconColumn::make('biaya_pembangunan_lunas')
                    ->label('Pembangunan')
                    ->boolean(),

                IconColumn::make('biaya_pkkbm_lunas')
                    ->label('PKKBM')
                    ->boolean(),

                IconColumn::make('biaya_spp_lunas')
                    ->label('SPP')
                    ->boolean(),

                IconColumn::make('biaya_praktikum_lunas')
                    ->label('Praktikum')
                    ->boolean(),

                IconColumn::make('is_ready_to_sync')
                    ->label('Ready')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPmbFinalCandidates::route('/'),
            'edit' => Pages\EditPmbFinalCandidate::route('/{record}/edit'),
        ];
    }
}
