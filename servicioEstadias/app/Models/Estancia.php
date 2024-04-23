<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre', 'fecha_inicio', 'fecha_cierre', 'archivo_convocatoria', 'vigente', 'id_estancia_requisito'
    ];

    public function requisitos()
    {
        return $this->hasMany(EstanciaRequisito::class, 'id_estancia_requisito');
    }
}
