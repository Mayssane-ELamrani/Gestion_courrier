<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [
        'nom',
        'responsable',
    ];

    public function courriersArrives()
    {
        return $this->hasMany(CourrierArrive::class, 'departement_id');
    }

    
    public function courriersDepart()
    {
        return $this->hasMany(CourrierDepart::class, 'departement_source_id');
    }
}
