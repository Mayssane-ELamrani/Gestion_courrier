<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Les attributs qui peuvent être assignés.
     */
    protected $fillable = [
        'matricule',
        'password',
        // ajoute les autres champs si besoin
    ];

    /**
     * Les attributs cachés dans les tableaux.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Permet d'utiliser "matricule" pour l'authentification.
     */
    public function getAuthIdentifierName()
    {
        return 'matricule';
    }
}

