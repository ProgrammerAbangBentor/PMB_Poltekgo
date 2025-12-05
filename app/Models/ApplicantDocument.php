<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantDocument extends Model
{
    protected $fillable = [
        'applicant_id',
        'document_field_id',
        'file_path',
    ];

    public function field()
    {
        return $this->belongsTo(DocumentField::class, 'document_field_id');
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

