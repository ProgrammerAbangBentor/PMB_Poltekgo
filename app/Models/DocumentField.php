<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentField extends Model
{
    protected $fillable = [
        'field_key',
        'label',
        'description',
        'allowed_types',
        'max_size',
        'is_required',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function uploads()
    {
        return $this->hasMany(ApplicantDocument::class, 'document_field_id');
    }
}

