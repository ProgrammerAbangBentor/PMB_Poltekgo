<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BiodataFieldResource\Pages;
use App\Models\BiodataField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BiodataFieldResource extends Resource
{
    protected static ?string $model = BiodataField::class;

    protected static ?string $navigationIcon  = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'Field Biodata';
    protected static ?string $navigationGroup = 'Konfigurasi Formulir PMB';
    protected static ?string $pluralLabel     = 'Field Biodata';
    protected static ?string $modelLabel      = 'Field Biodata';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konfigurasi Field')
                    ->description('Atur field biodata yang akan diisi oleh pendaftar.')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label('Label')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('field_key')
                            ->label('Key (untuk mapping SAKTI)')
                            ->helperText('Gunakan snake_case, tanpa spasi. Contoh: nik, tanggal_lahir, nama_ibu.')
                            ->required()
                            ->maxLength(100)
                            ->disabled(fn ($record) => $record?->is_lock), // kalau lock, key tidak bisa diubah

                        Forms\Components\Select::make('type')
                            ->label('Tipe Input')
                            ->options([
                                'text'     => 'Text',
                                'textarea' => 'Textarea',
                                'number'   => 'Number',
                                'date'     => 'Date',
                                'select'   => 'Select (Dropdown)',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('category')
                            ->label('Kategori')
                            ->placeholder('Contoh: Data Diri, Alamat, Orang Tua')
                            ->maxLength(100)
                            ->hidden(), // kalau nanti mau pakai kategori, tinggal hapus hidden()
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Aturan & Opsi')
                    ->schema([
                        Forms\Components\Toggle::make('is_required')
                            ->label('Wajib diisi')
                            ->default(false),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),

                        Forms\Components\Toggle::make('is_lock')
                            ->label('Kunci (tidak bisa dihapus)')
                            ->helperText('Aktifkan untuk field penting yang dipakai ke SAKTI.')
                            ->default(false),

                        Forms\Components\Textarea::make('options')
                            ->label('Opsi (untuk tipe select)')
                            ->rows(4)
                            ->helperText('Satu opsi per baris. Hanya digunakan jika tipe input = select.')
                            ->visible(fn (callable $get) => $get('type') === 'select')
                            ->afterStateHydrated(function ($component, $state) {
                                // dari array → textarea (baris per opsi)
                                if (is_array($state)) {
                                    $component->state(implode(PHP_EOL, $state));
                                }
                            })
                            ->dehydrateStateUsing(function ($state, callable $get) {
                                // jika bukan select → simpan null
                                if ($get('type') !== 'select') {
                                    return null;
                                }

                                $lines = collect(preg_split('/\r\n|\r|\n/', (string) $state))
                                    ->map(fn ($v) => trim($v))
                                    ->filter()
                                    ->values()
                                    ->all();

                                return $lines ?: null;
                            }),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Label')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('field_key')
                    ->label('Key')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->colors([
                        'primary' => ['text', 'textarea'],
                        'warning' => ['number', 'date'],
                        'success' => ['select'],
                    ])
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_required')
                    ->label('Wajib')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_lock')
                    ->label('Locked')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => ! $record->is_lock), // kalau lock, tidak bisa hapus
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(false), // biar tidak bisa bulk delete sembarangan
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBiodataFields::route('/'),
            'create' => Pages\CreateBiodataField::route('/create'),
            'edit'   => Pages\EditBiodataField::route('/{record}/edit'),
        ];
    }
}
