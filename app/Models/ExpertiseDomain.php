<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class ExpertiseDomain extends Model
{
    use SoftDeletes;    
    public $table = 'expertise_domains';

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

    
}
