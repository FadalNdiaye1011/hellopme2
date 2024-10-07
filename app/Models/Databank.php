<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class Databank extends Model
{
    use SoftDeletes;
    public $table = 'databanks';

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

    protected $casts = [
        'titre' => 'string',
        'description' => 'string',
        'nom_client' => 'string',
        'budget' => 'string',
        'started_at' => 'string',
        'deadline' => 'string'
    ];

    public static array $rules = [
        'titre' => 'required|string|max:255',
        'description' => 'required|string|max:65535',
        'nom_client' => 'nullable|string|max:255',
        'budget' => 'nullable|string|max:255',
        'started_at' => 'nullable|string|max:255',
        'deadline' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function typeOpportunity()
    {
        return $this->belongsTo('App\Models\TypeOpportunity');
    }


    public function secteurActivite()
    {
        return $this->hasManyThrough(SecteurActivite::class, SecteurActiviteChildren::class);
    }


    public function secteur_activite_children()
    {
        return $this->belongsTo('App\Models\SecteurActiviteChildren');
    }

    public function pays_partner()
    {
        return $this->belongsTo('App\Models\PaysPartner');
    }

    public function prescripteur()
    {
        return $this->belongsTo('App\Models\Prescripteur');
    }

}
