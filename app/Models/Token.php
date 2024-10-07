<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Token extends Model
{
    use SoftDeletes;    
    
    public $table = 'tokens';

    public $fillable = [
        'tokenable_type',
        'token',
        'refresh_token',
        'state',
        'user_id',
        'scope',
        'expired_at',
        'last_used_at'
    ];

    // public static array $rules = [
    //     'tokenable_type' => 'required',
    //     'token' => 'required',
    //     'refresh_token' => 'state'
    // ];

    
}
