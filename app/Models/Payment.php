<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'applicant_id',
        'order_id',
        'amount',
        'status',
        'snap_token',
        'payment_type',
        'transaction_id',
        'raw_response',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

  

}

