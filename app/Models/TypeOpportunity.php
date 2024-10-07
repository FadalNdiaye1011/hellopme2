<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class TypeOpportunity extends Model
{
    use SoftDeletes;
    public $table = 'type_opportunities';

    public $fillable = [
        'libelle'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'libelle' => 'string'
    ];

    public static array $rules = [
        'libelle' => 'required'
    ];


    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_type_opportunite');
    }


}
