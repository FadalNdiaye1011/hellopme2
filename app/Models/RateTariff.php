<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class RateTariff extends Model
{
    use SoftDeletes;    
    public $table = 'rate_tariffs';

    public $fillable = [
        'libelle',
        'value',
        'finance_id'
    ];

    protected $casts = [
        'libelle' => 'string',
        'value' => 'string'
    ];

    public static array $rules = [
        'libelle' => 'required',
        'value' => 'required',
        'finance_id' => 'required'
    ];

    
}
