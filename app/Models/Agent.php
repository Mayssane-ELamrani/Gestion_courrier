<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'provenance_id',
    ];

    public function provenance()
    {
        return $this->belongsTo(Provenance::class);
    }
}