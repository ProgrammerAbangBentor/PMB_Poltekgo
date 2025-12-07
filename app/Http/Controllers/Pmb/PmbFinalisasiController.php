<?php

namespace App\Http\Controllers\Pmb;

use App\Http\Controllers\Controller;
use App\Models\PmbFinalCandidate;
use App\Services\SaktiPmbService;

class PmbFinalisasiController extends Controller
{
    /**
     * FINALISASI: kirim data yang sudah ada di tabel PMB ke SAKTI
     */
    public function finalisasi($id)
    {
        // Ambil data PMB (bukan Applicant)
        $pmb = PmbFinalCandidate::findOrFail($id);

        // Buat payload untuk dikirim ke SAKTI
        $payload = [
            'nama'               => $pmb->nama,
            'tempat_lahir'       => $pmb->tempat_lahir,
            'tanggal_lahir'      => $pmb->tanggal_lahir,
            'jenis_kelamin'      => $pmb->jenis_kelamin,
            'agama'              => $pmb->agama,
            'kewarganegaraan'    => $pmb->kewarganegaraan,
            'nik'                => $pmb->nik,
            'nisn'               => $pmb->nisn,
            'npwp'               => $pmb->npwp,

            'jalan'              => $pmb->jalan,
            'dusun'              => $pmb->dusun,
            'rt'                 => $pmb->rt,
            'rw'                 => $pmb->rw,
            'kelurahan'          => $pmb->kelurahan,
            'kecamatan'          => $pmb->kecamatan,
            'kode_pos'           => $pmb->kode_pos,

            'hp'                 => $pmb->hp,
            'email'              => $pmb->email,
            'penerima_kps'       => $pmb->penerima_kps,
            'alat_transportasi'  => $pmb->alat_transportasi,
            'jenis_tinggal'      => $pmb->jenis_tinggal,

            // Orang tua
            'nama_ibu'           => $pmb->nama_ibu,
            'tanggal_lahir_ibu'  => $pmb->tanggal_lahir_ibu,
            'pendidikan_ibu'     => $pmb->pendidikan_ibu,
            'pekerjaan_ibu'      => $pmb->pekerjaan_ibu,
            'penghasilan_ibu'    => $pmb->penghasilan_ibu,

            'nama_ayah'          => $pmb->nama_ayah,
            'tanggal_lahir_ayah' => $pmb->tanggal_lahir_ayah,
            'pendidikan_ayah'    => $pmb->pendidikan_ayah,
            'pekerjaan_ayah'     => $pmb->pekerjaan_ayah,
            'penghasilan_ayah'   => $pmb->penghasilan_ayah,

            'nama_wali'          => $pmb->nama_wali,
            'tanggal_lahir_wali' => $pmb->tanggal_lahir_wali,
            'pendidikan_wali'    => $pmb->pendidikan_wali,
            'pekerjaan_wali'     => $pmb->pekerjaan_wali,
            'penghasilan_wali'   => $pmb->penghasilan_wali,

            // Mapping nama prodi, jalur, periode, gelombang
            'study_program_name' => $pmb->study_program_name,
            'entry_path_name'    => $pmb->entry_path_name,
            'pmb_period_name'    => $pmb->pmb_period_name,
            'pmb_wave_name'      => $pmb->pmb_wave_name,
        ];

        // ========== KIRIM KE SAKTI ==========
        $result = SaktiPmbService::sendToSakti($payload);

        if (!$result['success']) {
            return back()->with('error', 'Gagal mengirim ke SAKTI: ' . $result['message']);
        }

        // ========== UPDATE STATUS ==========
        $pmb->update([
            'is_ready_to_sync'   => true,
            'synced_to_sakti_at' => now(),
        ]);

        return back()->with('success', 'Data PMB berhasil dikirim ke SAKTI.');
    }
}
