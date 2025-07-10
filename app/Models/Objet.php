<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
        'deleted_at', 
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
