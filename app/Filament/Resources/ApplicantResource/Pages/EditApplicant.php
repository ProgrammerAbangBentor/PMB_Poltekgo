<?php

namespace App\Filament\Resources\ApplicantResource\Pages;

use App\Filament\Resources\ApplicantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications;

class EditApplicant extends EditRecord
{
    protected static string $resource = ApplicantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // TOMBOL KIRIM KE SAKTI
            Actions\Action::make('kirimSakti')
                ->label('Kirim ke SAKTI')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn ($record) => $record->is_lulus_final)
                ->action(function ($record) {
                    $record->update([
                        'synced_to_sakti_at' => now(),
                    ]);

                    Notifications\Notification::make()
                        ->title('Data siap dikirim ke SAKTI')
                        ->success()
                        ->send();
                }),

            // TOMBOL DELETE (tetap ada)
            Actions\DeleteAction::make(),
        ];
    }
}
