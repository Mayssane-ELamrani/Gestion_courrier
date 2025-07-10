<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etablissement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'raison_sociale',
        'provenance_id',
    ];

    public function provenance()
    {
        return $this->belongsTo(Provenance::class);
    }

    public function courriersArrives()
    {
        return $this->hasMany(CourrierArrive::class, 'etablissement_id');
    }
}