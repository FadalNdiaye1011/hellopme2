<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class PaysPartner extends Model
{
    use SoftDeletes;
    public $table = 'pays_partners';

    public $fillable = [
        'pays_id'
    ];

    protected $casts = [
        'pays_id' => 'integer'
    ];

    public static array $rules = [
        'pays_id' => 'required'
    ];

    public function one_pays()
    {
        return $this->belongsTo('App\Models\Pays', 'pays_id', 'id');
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
    }
}
