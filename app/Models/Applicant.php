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
        'entry_path_id',
        'nama',
        'email',
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
}
