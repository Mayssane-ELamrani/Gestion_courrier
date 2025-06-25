<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provenance extends Model
{
    protected $fillable = [
        'type',
    ];
    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

    public function etablissement()
    {
        return $this->hasOne(Etablissement::class);
    }
    public function courriersArrives()
    {
        return $this->hasMany(CourrierArrive::class);
    }
}
