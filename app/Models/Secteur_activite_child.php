<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

class Secteur_activite_child extends Model
{
    use SoftDeletes;
    public $table = 'secteur_activite_children';

    public $fillable = [
        'libelle',
        'secteur_activite_id'
    ];

    protected $casts = [
        'libelle' => 'string',
        'secteur_activite_id' => 'integer'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static array $rules = [
        'libelle' => 'required'
    ];

    // To comment
    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
    }

    public function secteurActivite()
    {
        return $this->belongsTo(SecteurActivite::class, 'secteur_activite_id'); // Remplace 'secteur_activite_id' par la clé étrangère correcte
    }
}
