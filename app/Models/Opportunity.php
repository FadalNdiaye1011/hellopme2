<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Opportunity extends Model
{
    use SoftDeletes;
    public $table = 'opportunities';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($opportunity) {
            $opportunitySlug = Str::slug($opportunity->titre);
            $opportunity->slug = strlen($opportunitySlug) <= 20 ? $opportunitySlug : substr($opportunitySlug, 0, 20);
        });
    }

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
        'prescripteur_id',
        'pays_partner_id',
        'secteur_activite_children_id',
        'type_opportunity_id',
        'is_featured',
    ];

    protected $casts = [
        'titre' => 'string',
        'description' => 'string',
        'type' => 'string',
        'nom_client' => 'string',
        'budget' => 'integer',
        'started_at' => 'string',
        'deadline' => 'string'
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public static array $rules = [
        'titre' => 'required',
        'description' => 'required',
        // 'type' => 'required',
        // 'nom_client' => 'required',
        // 'started_at' => 'required',
        'deadline' => 'required'
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
