<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class Address extends Model
{
    use SoftDeletes;    
    public $table = 'addresses';

    public $fillable = [
        'pays_id',
        'ville',
        'local_address'
    ];

    protected $casts = [
        'pays_id' => 'integer',
        'ville' => 'string',
        'local_address' => 'string'
    ];

    public static array $rules = [
        'pays_id' => 'required'
    ];

    
}
