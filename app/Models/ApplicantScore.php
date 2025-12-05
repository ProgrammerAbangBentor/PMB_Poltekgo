<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'scoring_rule_id',
        'score',
    ];

    // Relasi ke participant
    public function applicant()
    {
        return $this->belongsTo(Applicant::class , 'applicant_id');
    }

    // Relasi ke aturan nilai
    public function scoringRule()
    {
        return $this->belongsTo(ScoringRule::class);
    }

    // Status otomatis
    public function getStatusAttribute()
    {
        if (!$this->scoringRule) return '-';

        return $this->score >= $this->scoringRule->passing_score
            ? 'Lulus'
            : 'Tidak Lulus';
    }
}
