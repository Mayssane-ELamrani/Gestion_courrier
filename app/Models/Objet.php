<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    protected $fillable = [
        'nom',
        'description',
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
