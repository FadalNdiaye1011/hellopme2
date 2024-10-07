<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSecteurActiviteChildren extends Model
{
    use HasFactory;

     // Relation avec UserSecteurActivite
     public function userSecteurActivite()
     {
         return $this->belongsTo(UserSecteurActivite::class);
     }

     // Relation avec SecteurActiviteChildren
     public function secteurActiviteChildren()
     {
         return $this->belongsTo(SecteurActiviteChildren::class);
     }

}
