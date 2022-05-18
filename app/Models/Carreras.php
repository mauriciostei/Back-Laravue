<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','detalle'];

    public function materias(){
        return $this->hasMany(Materias::class);
    }
}
