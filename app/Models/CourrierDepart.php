<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourrierDepart extends Model
{
    protected $fillable = [
        'reference',
        'date_envoi',
        'matricule',
        'destinataire',
        'departement_source_id',
        'objet_id',
        'etat_id',
        'reference_courrierArrive', 
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'matricule', 'matricule');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_source_id');
    }

    public function objet()
    {
        return $this->belongsTo(Objet::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }
}
