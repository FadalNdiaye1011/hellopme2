<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class File extends Model
{
    use SoftDeletes;    
    public $table = 'files';

    public $fillable = [
        'id',
        'type',
        'source'
    ];

    protected $casts = [
        'type' => 'string',
        'source' => 'string'
    ];

    public static array $rules = [
        'id' => 'required',
        'type' => 'required'
    ];

    
}
