<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmbFinalCandidate extends Model
{
    protected $fillable = [
        'applicant_id',
        'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'agama', 'kewarganegaraan', 'nik', 'nisn', 'npwp',
        'jalan', 'dusun', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kode_pos',
        'hp', 'email', 'penerima_kps', 'alat_transportasi', 'jenis_tinggal',
        'nama_ibu', 'tanggal_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
        'nama_ayah', 'tanggal_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
        'nama_wali', 'tanggal_lahir_wali', 'pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali',
        'study_program_id', 'entry_path_id', 'pmb_period_id', 'pmb_wave_id',
        'biaya_pembangunan_lunas', 'biaya_pembangunan_at',
        'biaya_pkkbm_lunas', 'biaya_pkkbm_at',
        'biaya_spp_lunas', 'biaya_spp_at',
        'biaya_praktikum_lunas', 'biaya_praktikum_at',
        'is_ready_to_sync', 'synced_to_sakti_at',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

