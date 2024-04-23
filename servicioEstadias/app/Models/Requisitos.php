<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisitos extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'archivo_requisito', 'descargable'];

    // Relación con EstanciaRequisitos
    public function estancias()
    {
        return $this->hasMany(EstanciaRequisitos::class);
    }
}
