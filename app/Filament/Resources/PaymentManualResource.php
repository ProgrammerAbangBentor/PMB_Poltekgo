<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentManualResource\Pages;
use App\Models\PaymentManual;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;

class PaymentManualResource extends Resource
{
    protected static ?string $model = PaymentManual::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran Manual';
    protected static ?string $navigationGroup = 'Konfigurasi PMB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah Pembayaran')
                    ->numeric()
                    ->required(),

                Forms\Components\FileUpload::make('proof')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->directory('payment_proofs')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('applicant.nama')
                    ->label('Nama Pendaftar')
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR', true),

                ImageColumn::make('proof')
                    ->label('Bukti')
                    ->height(60),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),

                // APPROVE BUTTON
                Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status !== 'approved')
                    ->action(function ($record) {
                        $record->update(['status' => 'approved']);
                    }),

                // REJECT BUTTON
                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status !== 'rejected')
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                    }),

                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentManuals::route('/'),
            'edit' => Pages\EditPaymentManual::route('/{record}/edit'),
        ];
    }
}
