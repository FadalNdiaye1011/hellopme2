<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class SecteurActivite extends Model
{
    use SoftDeletes;
    public $table = 'secteur_activites';

    public $fillable = [
        'libelle'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'libelle' => 'string'
    ];

    public static array $rules = [
        'libelle' => 'required'
    ];

    public function opportunities()
    {
        return $this->hasManyThrough(Opportunity::class, SecteurActiviteChildren::class);
    }

    public function secteurActiviteChild()
    {
        return $this->hasMany('App\Models\SecteurActiviteChildren');
    }
    

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_secteur_activite');
    }

}
