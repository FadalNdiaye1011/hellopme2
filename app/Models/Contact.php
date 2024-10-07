<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function acteurFinance()
    {
        return $this->belongsTo(ActeurFinance::class, 'acteur_finance_id');
    }
}
