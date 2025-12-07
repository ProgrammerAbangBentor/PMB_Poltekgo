<?php

namespace App\Filament\Resources\PmbFinalCandidateResource\Pages;

use App\Filament\Resources\PmbFinalCandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class ListPmbFinalCandidates extends ListRecords
{
    protected static string $resource = PmbFinalCandidateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('syncToSakti')
                ->label('Kirim Semua ke SAKTI')
                ->icon('heroicon-o-arrow-up-circle')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {

                    $records = \App\Models\PmbFinalCandidate::where('is_ready_to_sync', true)->get();

                    if ($records->isEmpty()) {
                        Notification::make()
                            ->title('Tidak ada data yang siap dikirim ke SAKTI.')
                            ->warning()
                            ->send();
                        return;
                    }

                    $saktiUrl = rtrim(env('SAKTI_API_URL'), '/');
                    $endpoint = env('SAKTI_API_ENDPOINT', '/api/pmb/receive');
                    $fullUrl = $saktiUrl . $endpoint;

                    foreach ($records as $candidate) {
                        try {
                            // ==========================================
                            // PAYLOAD tanpa ID INTERNAL (aman)
                            // ==========================================
                            $payload = $candidate->only([
                                'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
                                'agama', 'kewarganegaraan', 'nik', 'nisn', 'npwp',
                                'jalan', 'dusun', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kode_pos',
                                'hp', 'email', 'penerima_kps', 'alat_transportasi', 'jenis_tinggal',
                                'nama_ibu', 'tanggal_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
                                'nama_ayah', 'tanggal_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
                                'nama_wali', 'tanggal_lahir_wali', 'pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali',
                                'study_program_name', 'entry_path_name', 'pmb_period_name', 'pmb_wave_name',
                            ]);

                            // ==========================================
                            // KIRIM KE SAKTI
                            // ==========================================
                            $response = Http::withHeaders([
                                'X-PMB-TOKEN' => env('SAKTI_SECRET_TOKEN'),
                                'Accept' => 'application/json'
                            ])->post($fullUrl, $payload);

                            if ($response->successful()) {
                                $candidate->update([
                                    'synced_to_sakti_at' => now(),
                                    'is_ready_to_sync'   => false,
                                ]);
                            } else {
                                Log::error("Gagal kirim kandidat {$candidate->id} ke SAKTI: " . $response->body());
                            }

                        } catch (\Exception $e) {
                            Log::error("Error kirim kandidat {$candidate->id}: {$e->getMessage()}");
                            continue;
                        }
                    }

                    Notification::make()
                        ->title('Proses kirim ke SAKTI selesai! Periksa log jika ada data gagal.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
