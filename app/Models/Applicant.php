<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Applicant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'pendaftar';

    protected $fillable = [
        'pmb_period_id',
        'pmb_wave_id',
        'study_program_id',
        'study_program_id_2',
        'entry_path_id',
        'nama',
        'email',
        'nik',
        'no_hp',
        'password',
        'no_pendaftaran',
        'status_registrasi',
        'registration_fee_paid_at',
        'is_biodata_complete',
        'is_documents_complete',
        'is_finalized',
        'is_file_selection_passed',
        'file_selection_decided_at',
        'is_entrance_selection_passed',
        'entrance_selection_decided_at',
        'is_re_registration_complete',
        're_registration_completed_at',
        'synced_to_sakti_at',
    ];

    protected $casts = [
        'registration_fee_paid_at' => 'datetime',
        'file_selection_decided_at' => 'datetime',
        'entrance_selection_decided_at' => 'datetime',
        're_registration_completed_at' => 'datetime',
        'synced_to_sakti_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function period()
    {
        return $this->belongsTo(PmbPeriod::class, 'pmb_period_id');
    }

    public function wave()
    {
        return $this->belongsTo(PmbWave::class, 'pmb_wave_id');
    }

    public function program()
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }

    public function program2()
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id_2');
    }


    public function path()
    {
        return $this->belongsTo(EntryPath::class, 'entry_path_id');
    }

    public function fields()
    {
        return $this->hasMany(ApplicantFieldValue::class);
    }

    public function fieldValues()
    {
        return $this->hasMany(ApplicantFieldValue::class, 'applicant_id');
    }

    public function documentValues()
    {
        return $this->hasMany(ApplicantDocument::class, 'applicant_id');
    }

    public function scores()
    {
        return $this->hasMany(ApplicantScore::class);
    }


    /*
    |--------------------------------------------------------------------------
    | ACCESSOR NILAI & STATUS FINAL
    |--------------------------------------------------------------------------
    */

    /**
     * Ambil nilai terbaru berdasarkan ID DESC
     * (lebih akurat dibanding latest() by timestamp).
     */
    public function getLatestScoreAttribute()
    {
        return $this->scores()->orderBy('id', 'desc')->first();
    }

    /**
     * Status kelulusan nilai berdasarkan scoring rule.
     */
    public function getIsNilaiLulusAttribute()
    {
        $score = $this->latest_score;

        if (!$score || !$score->scoringRule) {
            return false;
        }

        return $score->score >= $score->scoringRule->passing_score;
    }

    /**
     * Status kelulusan seleksi berkas.
     */
    public function getIsBerkasLulusAttribute()
    {
        return (bool) $this->is_file_selection_passed;
    }

    /**
     * Status lulus final (berkas + nilai).
     */
    public function getIsLulusFinalAttribute()
    {
        return $this->is_berkas_lulus && $this->is_nilai_lulus;
    }


    public function payment()
{
    return $this->hasOne(\App\Models\Payment::class, 'applicant_id');
}

    public function toFinalCandidateData()
    {
        // Ambil semua nilai biodata
        $biodata = $this->fieldValues()
            ->with('field')
            ->get()
            ->pluck('field_value', 'field.field_key'); // ['nik' => '123', ...]

        return [
            // Data wajib SAKTI
            'nama' => $this->nama,
            'tempat_lahir' => $biodata['tempat_lahir'] ?? null,
            'tanggal_lahir' => $biodata['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $biodata['jenis_kelamin'] ?? null,
            'agama' => $biodata['agama'] ?? null,
            'kewarganegaraan' => $biodata['kewarganegaraan'] ?? null,
            'nik' => $biodata['nik'] ?? null,
            'nisn' => $biodata['nisn'] ?? null,
            'npwp' => $biodata['npwp'] ?? null,

            // Alamat
            'jalan' => $biodata['jalan'] ?? null,
            'dusun' => $biodata['dusun'] ?? null,
            'rt' => $biodata['rt'] ?? null,
            'rw' => $biodata['rw'] ?? null,
            'kelurahan' => $biodata['kelurahan'] ?? null,
            'kecamatan' => $biodata['kecamatan'] ?? null,
            'kode_pos' => $biodata['kode_pos'] ?? null,

            // Kontak
            'hp' => $biodata['hp'] ?? $this->no_hp,
            'email' => $biodata['email'] ?? $this->email,

            // Info tambahan
            'penerima_kps' => $biodata['penerima_kps'] ?? null,
            'alat_transportasi' => $biodata['alat_transportasi'] ?? null,
            'jenis_tinggal' => $biodata['jenis_tinggal'] ?? null,

            // Ibu
            'nama_ibu' => $biodata['nama_ibu'] ?? null,
            'tanggal_lahir_ibu' => $biodata['tanggal_lahir_ibu'] ?? null,
            'pendidikan_ibu' => $biodata['pendidikan_ibu'] ?? null,
            'pekerjaan_ibu' => $biodata['pekerjaan_ibu'] ?? null,
            'penghasilan_ibu' => $biodata['penghasilan_ibu'] ?? null,

            // Ayah
            'nama_ayah' => $biodata['nama_ayah'] ?? null,
            'tanggal_lahir_ayah' => $biodata['tanggal_lahir_ayah'] ?? null,
            'pendidikan_ayah' => $biodata['pendidikan_ayah'] ?? null,
            'pekerjaan_ayah' => $biodata['pekerjaan_ayah'] ?? null,
            'penghasilan_ayah' => $biodata['penghasilan_ayah'] ?? null,

            // Wali
            'nama_wali' => $biodata['nama_wali'] ?? null,
            'tanggal_lahir_wali' => $biodata['tanggal_lahir_wali'] ?? null,
            'pendidikan_wali' => $biodata['pendidikan_wali'] ?? null,
            'pekerjaan_wali' => $biodata['pekerjaan_wali'] ?? null,
            'penghasilan_wali' => $biodata['penghasilan_wali'] ?? null,

            // Mapping PMB
            'study_program_id' => $this->study_program_id,
            'entry_path_id' => $this->entry_path_id,
            'pmb_period_id' => $this->pmb_period_id,
            'pmb_wave_id' => $this->pmb_wave_id,
        ];
    }


}
