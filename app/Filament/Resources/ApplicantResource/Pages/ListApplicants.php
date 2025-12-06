<?php

namespace App\Filament\Resources\ApplicantResource\Pages;

use App\Filament\Resources\ApplicantResource;
use App\Models\PmbFinalCandidate;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicants extends ListRecords
{
    protected static string $resource = ApplicantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('kirimFinal')
                ->label('Pindahkan ke Final PMB')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->action(function ($record) {

                    // CEK SYARAT FINAL
                    if (
                        !$record->is_biodata_complete ||
                        !$record->is_documents_complete ||
                        !$record->is_berkas_lulus ||
                        !$record->is_nilai_lulus
                    ) {
                        $this->notify('danger', 'Pendaftar belum memenuhi syarat final.');
                        return;
                    }

                    // GET BIODATA MAPPING
                    $data = $record->toFinalCandidateData();

                    // INSERT / UPDATE KE TABEL FINAL
                    PmbFinalCandidate::updateOrCreate(
                        ['applicant_id' => $record->id],
                        $data
                    );

                    $this->notify('success', 'Pendaftar berhasil dipindahkan ke Final PMB.');
                })
                ->visible(fn () => true),
        ];
    }
}
