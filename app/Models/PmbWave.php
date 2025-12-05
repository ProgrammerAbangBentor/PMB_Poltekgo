<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Models\PmbWave;

class PmbWave extends Model
{
    use HasFactory;

    protected $fillable = [
        'pmb_period_id',
        'nama_gelombang',
        'tanggal_mulai',
        'tanggal_selesai',
        'biaya_pendaftaran',
        'is_active',
    ];

    public function period()
    {
        return $this->belongsTo(PmbPeriod::class, 'pmb_period_id');
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'pmb_wave_id');
    }
}


