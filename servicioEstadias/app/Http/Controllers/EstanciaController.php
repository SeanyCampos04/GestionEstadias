<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstanciaController extends Controller
{
    //apartado para redirigir a vistas
    public function create()
    {
        return view('admi.createEstancia');
    }
    public function showSolicitudes()
    {
        $solicitudes = SolicitudesEstancias::all();
        return view('admi.solicitudes', ['solicitudes' => $solicitudes]);
    }
    public function historicoSolicitudes()
    {
        $estancias = Estancia::all();

        return view('admi.historicoSolicitudes', compact('estancias'));
    }
}
