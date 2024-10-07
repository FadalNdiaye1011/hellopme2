<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Scrap extends Model
{
    use HasFactory;

    protected $table = 'scraps';


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
