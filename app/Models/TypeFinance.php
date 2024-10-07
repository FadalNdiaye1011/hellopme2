<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFinance extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];

    public function acteurFinances()
    {
        return $this->hasMany(ActeurFinance::class, 'type_finance_id');
    }

}
