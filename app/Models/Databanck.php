<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Databanck extends Model
{
    use SoftDeletes;
    protected $table = 'databancks';


    public $fillable = [
        'titre',
        'description',
        'slug',
        'image_url',
        'criteres',
        'source',
        'budget',
        'nom_contact',
        'role_contact',
        'phone_contact',
        'started_at',
        'lieu',
        'deadline_question',
        'deadline',
        'pays_partner_id',
        'type_opportunity_id',
        'prescripteur_id',
        'secteur_activite_children_id',
        'detail',
    ];



    

}
