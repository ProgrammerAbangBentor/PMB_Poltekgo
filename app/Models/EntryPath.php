<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntryPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'is_active',
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'entry_path_id');
    }
}

