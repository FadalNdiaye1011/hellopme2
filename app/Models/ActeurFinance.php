<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeurFinance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function typeFinance()
    {
        return $this->belongsTo(TypeFinance::class, 'type_finance_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'acteur_finance_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'acteur_services', 'acteur_finance_id', 'service_id') ->withPivot('commentaire')->withTimestamps();
    }

    public function pays_partners()
    {
        return $this->belongsTo(PaysPartner::class);
    }

}



