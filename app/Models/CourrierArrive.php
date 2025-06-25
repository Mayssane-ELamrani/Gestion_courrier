<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourrierArrive extends Model
{
     protected $fillable = [
        'reference',
        'date_reception',
        'notation',
        'date_envoi',
        'matricule',
        'provenance_id',
        'departement_id',
        'objet_id',
        'etat_id',
        'reponse_id',
    ];
    public function personne(){
        return $this->belongsTo(Personne::class, 'matricule', 'matricule');
    }
    public function reponse(){
        return $this->belongsTo(Reponse::class);
    }
    public function etat(){
        return $this->belongsTo(Etat::class);
    }
    public function provenance(){
        return $this->belongsTo(Provenance::class);
    }
    public function departement(){
        return $this->belongsTo(Departement::class);
    }
    public function objet(){
        return $this->belongsTo(Objet::class);
    }
};
