<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicantResource\Pages;
use App\Models\Applicant;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class ApplicantResource extends Resource
{
    protected static ?string $model = Applicant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'PMB';
    protected static ?string $navigationLabel = 'Pendaftar';
    protected static ?string $modelLabel = 'Pendaftar PMB';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('ApplicantTabs')
                ->tabs([

                    // ===================== TAB 1: INFO DASAR =====================
                    Forms\Components\Tabs\Tab::make('Info Akun')
                        ->schema([
                            Forms\Components\TextInput::make('nama')->label('Nama')->required(),
                            Forms\Components\TextInput::make('email')->email()->required(),
                            Forms\Components\TextInput::make('no_hp')->tel(),
                        ])->columns(3),

                    Forms\Components\Tabs\Tab::make('Info PMB')
                        ->schema([
                            // Forms\Components\Select::make('pmb_period_id')
                            //     ->relationship('period', 'nama_periode')
                            //     ->label('Periode PMB'),

                            // Forms\Components\Select::make('pmb_wave_id')
                            //     ->relationship('wave', 'nama_gelombang')
                            //     ->label('Gelombang'),

                            // Forms\Components\Select::make('study_program_id')
                            //     ->relationship('program', 'nama_program')
                            //     ->label('Program Studi'),

                            // Forms\Components\Select::make('entry_path_id')
                            //     ->relationship('path', 'nama_jalur')
                            //     ->label('Jalur Masuk'),
                        ])->columns(2),

                    // ===================== TAB 2: BIODATA =====================
                    Forms\Components\Tabs\Tab::make('Biodata')
                        ->schema([
                            Forms\Components\ViewField::make('biodata-view')
                                ->view('admin.applicants.biodata'),
                        ]),

                    // ===================== TAB 3: DOKUMEN =====================
                    Forms\Components\Tabs\Tab::make('Dokumen')
                        ->schema([
                            Forms\Components\ViewField::make('document-view')
                                ->view('admin.applicants.documents'),
                        ]),

                    // ===================== TAB 4: STATUS =====================
                    Forms\Components\Tabs\Tab::make('Status Seleksi')
                        ->schema([
                            Forms\Components\Toggle::make('is_biodata_complete')
                                ->label('Biodata Lengkap?'),

                            Forms\Components\Toggle::make('is_documents_complete')
                                ->label('Dokumen Lengkap?'),

                            Forms\Components\Toggle::make('is_file_selection_passed')
                                ->label('Lulus Seleksi Berkas?'),

                            Forms\Components\DateTimePicker::make('file_selection_decided_at')
                                ->label('Tanggal Keputusan')
                                ->visible(fn ($get) => $get('is_file_selection_passed') !== null),
                        ])->columns(2),

                ])
                ->columnSpanFull(),
        ]);
    }


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('is_biodata_complete')
                    ->label('Biodata')
                    ->formatStateUsing(fn ($state) => $state ? 'Lengkap' : 'Belum')
                    ->colors([
                        'success' => fn ($state) => (bool) $state === true,
                        'danger'  => fn ($state) => (bool) $state === false,
                    ]),

                Tables\Columns\BadgeColumn::make('is_documents_complete')
                    ->label('Dokumen')
                    ->formatStateUsing(fn ($state) => $state ? 'Lengkap' : 'Belum')
                    ->colors([
                        'success' => fn ($state) => (bool) $state === true,
                        'danger'  => fn ($state) => (bool) $state === false,
                    ]),

                Tables\Columns\BadgeColumn::make('is_file_selection_passed')
                    ->label('Seleksi Berkas')
                    ->formatStateUsing(function ($state) {
                        return match (true) {
                            $state === 1    => 'Lulus',
                            $state === 0    => 'Tidak Lulus',
                            default         => 'Pending',
                        };
                    })
                    ->colors([
                        'success' => fn ($state) => $state === 1,
                        'danger'  => fn ($state) => $state === 0,
                        'warning' => fn ($state) => is_null($state),
                    ]),

                // ★ STATUS NILAI
                Tables\Columns\BadgeColumn::make('nilai_status')
                    ->label('Nilai')
                    ->getStateUsing(fn ($record) => $record->is_nilai_lulus ? 'Lulus' : 'Tidak')
                    ->colors([
                        'success' => fn ($record) => $record->is_nilai_lulus,
                        'danger'  => fn ($record) => !$record->is_nilai_lulus,
                    ]),

                // ★ STATUS FINAL (BERKAS + NILAI)
                Tables\Columns\BadgeColumn::make('final_status')
                    ->label('Final')
                    ->getStateUsing(fn ($record) => $record->is_lulus_final ? 'Lulus Final' : 'Belum')
                    ->colors([
                        'success' => fn ($record) => $record->is_lulus_final,
                        'warning' => fn ($record) => !$record->is_lulus_final,
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplicants::route('/'),
            'create' => Pages\CreateApplicant::route('/create'),
            'edit' => Pages\EditApplicant::route('/{record}/edit'),
        ];
    }
}
