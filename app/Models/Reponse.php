<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable= [
        'choix',
    ];
    public function courrierArrive()
    {
        return $this->hasMany(CourrierArrive::class, 'courrier_arrive_id');
    }
}
