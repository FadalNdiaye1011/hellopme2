<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    public $table = 'pays';

    public $fillable = [
        'code_pays',
        'fr',
        'en'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
    }
}
