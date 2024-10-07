<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    public $fillable = [
        'order_number',
        'date_payment',
        'state_payment',
        'user_name',
        'user_phone',
        'user_email',
        'user_abonnement_id',
    ];
}
