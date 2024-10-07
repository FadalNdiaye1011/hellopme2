<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class UserAbonnement extends Model
{
    use SoftDeletes;    
    public $table = 'user_abonnements';

    public $fillable = [
        'user_id',
        'abonnement_id',
        'end_date',
        'price',
        'status'
    ];

    protected $casts = [
        'end_date' => 'datetime',
        'price' => 'float'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'abonnement_id' => 'required',
        'end_date' => 'required',
        'price' => 'required|numeric',
        'status' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function abonnement()
    {
        return $this->belongsTo(Abonnement::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'user_abonnement_id');
    }
}
