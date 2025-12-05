<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantFieldValue extends Model
{
    protected $fillable = [
        'applicant_id',
        'biodata_field_id',
        'field_value',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function field()
    {
        return $this->belongsTo(BiodataField::class, 'biodata_field_id');
    }

    
}

