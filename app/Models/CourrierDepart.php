<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class CourrierDepart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courrier_departs';

    protected $fillable = [
        'reference',
        'date_envoi',
        'destinataire',
        'departement_source_id',
        'objet_id',
        'description_objet',
        'etat_id',
        'reference_courrierArrive',    
        'matricule',
        'type_source',
        'nom_agent',
        'type_espace',
        'deleted_by',  
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

    public function userDeleteur()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }
}
