<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    protected $fillable = [
        'nom',
    ];

    public function courriersArrives()
    {
        return $this->hasMany(CourrierArrive::class);
    }

    public function courriersDepart()
    {
        return $this->hasMany(CourrierDepart::class);
    }
}
