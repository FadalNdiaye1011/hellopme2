<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class Prescripteur extends Model
{
    use SoftDeletes;    
    public $table = 'prescripteurs';

    public $fillable = [
        'libelle',
        'logo',
        'website',
        'titre_responsable',
        'nom_responsable',
        'phone_responsable',
        'town',
        'pays_id',
        'finance_id'
    ];

    protected $casts = [
        'libelle' => 'string',
        'logo' => 'string',
        'titre_responsable' => 'string',
        'nom_responsable' => 'string',
        'phone_responsable' => 'string'
    ];

    public static array $rules = [
        'libelle' => 'required',
        'nom_responsable' => 'required',
        'phone_responsable' => 'required'
    ];

    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
    }   
}
