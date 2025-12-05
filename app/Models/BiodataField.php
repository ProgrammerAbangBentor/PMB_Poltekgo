<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiodataField extends Model
{
    protected $fillable = [
        'field_key',
        'label',
        'type',
        'is_required',
        'is_lock',
        'is_active',
        'sort_order',
        'options',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_lock' => 'boolean',
        'is_active' => 'boolean',
        'options' => 'array',
    ];

    public function values()
    {
        return $this->hasMany(ApplicantFieldValue::class);
    }
}

