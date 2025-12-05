<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScoringRuleResource\Pages;
use App\Models\ScoringRule;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class ScoringRuleResource extends Resource
{
    protected static ?string $model = ScoringRule::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Standarisasi Nilai PMB';
    protected static ?string $navigationLabel = 'Standarisasi Nilai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Aturan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('min_score')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Forms\Components\TextInput::make('max_score')
                    ->numeric()
                    ->default(100)
                    ->required(),

                Forms\Components\TextInput::make('passing_score')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif?')
                    ->default(true),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Aturan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('min_score')
                    ->label('Min'),

                Tables\Columns\TextColumn::make('max_score')
                    ->label('Max'),

                Tables\Columns\TextColumn::make('passing_score')
                    ->label('Passing'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScoringRules::route('/'),
            'create' => Pages\CreateScoringRule::route('/create'),
            'edit' => Pages\EditScoringRule::route('/{record}/edit'),
        ];
    }
}
