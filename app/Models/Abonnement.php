<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class Abonnement extends Model
{
    use SoftDeletes;    
    public $table = 'abonnements';

    public $fillable = [
        'type',
        'durations',
        'statut',
        'price',
        'user_id',
    ];

    protected $casts = [
        'price' => 'float'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'abonnement_id' => 'required',
        'price' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
}
