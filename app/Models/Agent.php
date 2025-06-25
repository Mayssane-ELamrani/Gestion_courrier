<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
     protected $fillable = [
        'nom',
        'prenom',
        'matricule',
     ];
      public function provenance()
    {
        return $this->belongsTo(Provenance::class);
    }
}