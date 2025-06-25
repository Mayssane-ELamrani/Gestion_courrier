<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $fillable = [
        'raison_sociale',
    ];

    public function courriersArrives()
    {
        return $this->hasMany(CourrierArrive::class, 'etablissement_id');
    }
 public function provenance()
    {
        return $this->belongsTo(Provenance::class);
    }
  
}
