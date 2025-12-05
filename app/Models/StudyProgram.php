<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'jenjang',
        'is_active',
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'study_program_id');
    }
}
