<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class ValidationEmail extends Model
{
    use SoftDeletes;    
    public $table = 'validation_emails';

    public $fillable = [
        'code',
        'email'
    ];

    protected $casts = [
        'code' => 'integer',
        'email' => 'string'
    ];

    public static array $rules = [
        'code' => 'required',
        'email' => 'required'
    ];

    
}
