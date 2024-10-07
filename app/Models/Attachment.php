<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class Attachment extends Model
{
    use SoftDeletes;    
    public $table = 'attachments';

    public $fillable = [
        'opportunity_id',
        'databank_id',
        'file_id',
        'url'
    ];

    protected $casts = [
    ];

    public static array $rules = [
        'url' => 'required',
        'file_id' => 'required'
    ];

    
}
