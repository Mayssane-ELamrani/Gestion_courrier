<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourrierArrive extends Model
{
    use SoftDeletes;

    protected $table = 'courrier_arrives';

    protected $fillable = [
        'reference',
        'date_reception',
        'annotation',
        'date_envoi',
        'matricule',
        'objet_id',
        'description_objet',
        'etat_id',
        'agent_nom',
        'agent_prenom',
        'agent_matricule',
        'etablissement_raison_sociale',
        'departement_id',
        'reponse_id',
        'provenance_id',
        'type_espace',
       'reference_courrierDepart',

        'deleted_by',
    ];

    protected $casts = [
        'date_reception' => 'date',
        'date_envoi' => 'date',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'matricule', 'matricule');
    }

    public function objet()
    {
        return $this->belongsTo(Objet::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function reponse()
    {
        return $this->belongsTo(Reponse::class);
    }

    public function provenance()
    {
        return $this->belongsTo(Provenance::class);
    }
}
