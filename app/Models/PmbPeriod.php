<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PmbPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_periode',
        'tahun',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];

    public function waves()
    {
        return $this->hasMany(PmbWave::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'pmb_period_id');
    }
}

