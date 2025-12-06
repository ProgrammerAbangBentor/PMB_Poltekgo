<?php

namespace App\Filament\Resources;

use App\Models\StudyProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudyProgramResource extends Resource
{
    protected static ?string $model = StudyProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Konfigurasi PMB';
    protected static ?string $navigationLabel = 'Program Studi';
    protected static ?string $modelLabel = 'Program Studi';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\TextInput::make('kode')
                ->label('Kode Prodi')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('nama')
                ->label('Nama Program Studi')
                ->required(),

            Forms\Components\Select::make('jenjang')
                ->label('Jenjang')
                ->options([
                    'D3' => 'Diploma 3',
                    'D4' => 'Diploma 4',
                    'S1' => 'Sarjana',
                ])
                ->required(),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktif?')
                ->inline(false)
                ->helperText('Jika tidak aktif, prodi tidak tampil pada UI pendaftar'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Program Studi')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang'),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif')
                    ->colors([
                        'success' => fn ($state) => $state === true,
                        'danger'  => fn ($state) => $state === false,
                    ]),

            ])
            ->defaultSort('nama')
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => StudyProgramResource\Pages\ListStudyPrograms::route('/'),
            'create' => StudyProgramResource\Pages\CreateStudyProgram::route('/create'),
            'edit'   => StudyProgramResource\Pages\EditStudyProgram::route('/{record}/edit'),
        ];
    }
}
