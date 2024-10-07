<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SecteurActiviteChildren extends Model
{
    use SoftDeletes;
    public $table = 'secteur_activite_children';

    public $fillable = [
        'image',
        'libelle',
        'secteur_activite_id'
    ];

    protected $casts = [

    ];

    public static array $rules = [
        'libelle' => 'required',
        'secteur_activite_id' => 'required'
    ];

    public function secteurActivite()
    {
        return $this->belongsTo('App\Models\SecteurActivite');
    }
}
