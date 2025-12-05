<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicantScoreResource\Pages;
use App\Models\ApplicantScore;
use App\Models\ScoringRule;
use App\Models\Applicant;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ApplicantScoreResource extends Resource
{
    protected static ?string $model = ApplicantScore::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Standarisasi Nilai PMB';
    protected static ?string $navigationLabel = 'Penilaian Peserta';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('applicant_id')
                    ->label('Pendaftar')
                    ->relationship('applicant', 'nama')
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('scoring_rule_id')
                    ->label('Aturan Nilai')
                    ->options(ScoringRule::pluck('name', 'id'))
                    ->required(),

                Forms\Components\TextInput::make('score')
                    ->label('Nilai')
                    ->numeric()
                    ->required()
                    ->rule(function () {
                        $rule = ScoringRule::where('is_active', true)->first();

                        return function ($attribute, $value, $fail) use ($rule) {
                            if (!$rule) return;

                            if ($value < $rule->min_score || $value > $rule->max_score) {
                                $fail("Nilai harus antara {$rule->min_score} - {$rule->max_score}");
                            }
                        };
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('applicant.nama')->label('Pendaftar')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('scoringRule.name')->label('Aturan'),
                Tables\Columns\TextColumn::make('score')->label('Nilai'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Lulus',
                        'danger' => 'Tidak Lulus',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplicantScores::route('/'),
            'create' => Pages\CreateApplicantScore::route('/create'),
            'edit' => Pages\EditApplicantScore::route('/{record}/edit'),
        ];
    }
}
