//modelo
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_estancia', 'requisitos',
    ];

    /**
     * Get the estancia that owns the solicitud.
     */
    public function estancia()
    {
        return $this->belongsTo(Estancia::class, 'id_estancia');
    }
}