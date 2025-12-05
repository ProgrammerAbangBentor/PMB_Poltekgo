<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentManual extends Model
{
    protected $fillable = [
        'applicant_id',
        'amount',
        'status',
        'proof'
    ];

    protected $table = 'payments_manual';

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

