<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'email',
        'email_verified_at',
        'avatar',
        'phone',
        'is_onboarding',
        'whatsapp',
        'bio',
        'linkedin',
        'facebook',
        'twitter',
        'address_id',
        'pays_partner_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Validation rules
    *
    * @var array
    */
    public static $login = [
        'email' => 'required',
        'password' => 'required'
    ];

    public static $refresh_token = [
        'refresh_token' => 'required'
    ];

    public static $register = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users',
    ];

    public function watchlists()
    {
        return $this->hasMany(Watchlist::class);
    }

    public function abonnements()
    {
        return $this->hasMany(UserAbonnement::class);
    }

    public function typeOpportunities()
    {
        return $this->belongsToMany(TypeOpportunity::class, 'user_type_opportunite');
    }

    public function secteurs()
    {
        return $this->belongsToMany(SecteurActivite::class, 'user_secteur_activite');
    }

    public function sousSecteurs()
    {
        return $this->belongsToMany(SecteurActiviteChildren::class, 'user_sous_secteur');
    }

}
