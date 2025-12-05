<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentFieldResource\Pages;
use App\Models\DocumentField;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class DocumentFieldResource extends Resource
{
    protected static ?string $model = DocumentField::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konfigurasi Formulir PMB';
    protected static ?string $navigationLabel = 'Master Dokumen';
    protected static ?string $modelLabel = 'Jenis Dokumen';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('field_key')
                    ->label('Key Dokumen')
                    ->helperText('Gunakan huruf kecil tanpa spasi. Contoh: ktp, ijazah, pas_foto')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                Forms\Components\TextInput::make('label')
                    ->label('Nama Dokumen')
                    ->required()
                    ->maxLength(100),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(2),

                Forms\Components\TextInput::make('allowed_types')
                    ->label('Tipe diperbolehkan')
                    ->helperText('Pisahkan dengan koma. Contoh: jpg,png,pdf')
                    ->default('jpg,png,pdf')
                    ->required(),

                Forms\Components\TextInput::make('max_size')
                    ->numeric()
                    ->suffix('KB')
                    ->label('Ukuran Maksimal')
                    ->default(2048)
                    ->required(),

                Forms\Components\Toggle::make('is_required')
                    ->label('Wajib diunggah?')
                    ->default(true),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif?')
                    ->default(true),

                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->label('Urutan Tampil')
                    ->default(0),
            ])
            ->columns(2);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Nama Dokumen')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('field_key')
                    ->label('Key'),

                Tables\Columns\IconColumn::make('is_required')
                    ->label('Wajib')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('allowed_types')
                    ->label('Tipe File')
                    ->sortable(),

                Tables\Columns\TextColumn::make('max_size')
                    ->label('Max Size (KB)')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDocumentFields::route('/'),
            'create' => Pages\CreateDocumentField::route('/create'),
            'edit'   => Pages\EditDocumentField::route('/{record}/edit'),
        ];
    }
}
