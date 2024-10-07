<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function acteursFinance()
    {
        return $this->belongsToMany(ActeurFinance::class, 'acteur_service', 'service_id', 'acteur_finance_id')->withPivot('commentaire');;
    }



}
