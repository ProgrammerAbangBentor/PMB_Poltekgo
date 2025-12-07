<?php

namespace App\Filament\Resources\ApplicantResource\Pages;

use App\Filament\Resources\ApplicantResource;
use App\Models\PmbFinalCandidate;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListApplicants extends ListRecords
{
    protected static string $resource = ApplicantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('kirimSemuaLolos')
                ->label('Kirim Semua yang Lolos Final')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {

                    $records = \App\Models\Applicant::with(['program','path','period','wave'])
                        ->where('is_biodata_complete', 1)
                        ->where('is_documents_complete', 1)
                        ->where('is_file_selection_passed', 1)
                        ->get()
                        ->filter(fn($item) => $item->is_lulus_final);

                    if ($records->isEmpty()) {
                        Notification::make()
                            ->title('Tidak ada pendaftar yang memenuhi syarat final.')
                            ->warning()
                            ->send();
                        return;
                    }

                    foreach ($records as $record) {
                        $record->loadMissing(['program','path','period','wave']);

                        $data = $record->toFinalCandidateData();

                        \App\Models\PmbFinalCandidate::updateOrCreate(
                            ['applicant_id' => $record->id],
                            $data
                        );
                    }

                    Notification::make()
                        ->title('Semua pendaftar yang lolos Final berhasil dipindahkan!')
                        ->success()
                        ->send();
                }),
        ];
    }

}
