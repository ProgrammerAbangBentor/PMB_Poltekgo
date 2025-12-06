<?php

namespace App\Filament\Resources;

use App\Models\EntryPath;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EntryPathResource extends Resource
{
    protected static ?string $model = EntryPath::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Konfigurasi PMB';
    protected static ?string $navigationLabel = 'Jalur Masuk';
    protected static ?string $modelLabel = 'Jalur Masuk';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\TextInput::make('kode')
                ->label('Kode Jalur')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('nama')
                ->label('Nama Jalur Masuk')
                ->required(),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktif?')
                ->inline(false)
                ->helperText('Jika tidak aktif, jalur ini tidak muncul pada UI pendaftar.'),

        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Jalur')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Non Aktif')
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
            'index'  => EntryPathResource\Pages\ListEntryPaths::route('/'),
            'create' => EntryPathResource\Pages\CreateEntryPath::route('/create'),
            'edit'   => EntryPathResource\Pages\EditEntryPath::route('/{record}/edit'),
        ];
    }
}
