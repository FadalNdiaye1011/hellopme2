<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class AreaInterest extends Model
{
    use SoftDeletes;    
    public $table = 'area_of_interest';

    public $fillable = [
        'libelle',
        'type',
        'type_opportunity_id',
        'pays_partner_id',
        'secteur_activite_id',
        'expertise_domain_id',
        'user_id'
    ];

    protected $casts = [
        'libelle' => 'string',
        'type' => 'string',
        'type_opportunity_id' => 'integer',
        'pays_partner_id' => 'integer',
        'secteur_activite_id' => 'integer',
        'expertise_domain_id' => 'integer',
        'user_id' => 'integer'
    ];

    public static array $rules = [
        'libelle' => 'required',
        'type' => 'required',
        'user_id' => 'required'
    ];

    
}
