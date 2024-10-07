<?php

namespace App\Models;
use App\Models\Estanciarequisitos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_estancia', 'email', 'requisitos', 'status', 'docente', 'fecha_solicitud', 'observaciones','empresa', 'status_convenio','periodo_duracion'
    ];

    /**
     * Get the estancia that owns the solicitud.
     */
    /*public function estanciaRequisitos()
    {
        return $this->belongsTo(EstanciaRequisitos::class,  'id_estancia');
    }

    public function estancia()
    {
        return $this->estanciaRequisitos->belongsTo(Estancia::class, 'id');
    }*/public function estanciaRequisitos()
    {
        return $this->belongsTo(EstanciaRequisitos::class, 'id_estancia');
    }

    public function estancia()
    {
        return $this->belongsTo(Estancia::class, 'id_estancia');
    }
    public function docente()
    {
        return $this->belongsTo(User::class, 'id');
    }
}