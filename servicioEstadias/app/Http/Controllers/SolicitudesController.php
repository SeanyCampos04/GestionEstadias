<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Estancia;
use App\Models\Estanciarequisitos;
use App\Models\Requisitos;
use App\Models\Solicitudes;

use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    //
    public function userCreateSolicitud($id)
    {   
        // Obtener los detalles de la estancia
        $estancia = Estancia::find($id);
    
        if (!$estancia) {
            abort(404);
        }

        // Obtener los requisitos de la estancia
        $requisitosEstancia = EstanciaRequisitos::where('id_estancia', $id)->first();
        
        if (!$requisitosEstancia) {
            abort(404, 'No se encontraron requisitos para la estancia.');
        }
    
        // Convertir el JSON de requisitos en un array de IDs
        $requisitosIds = json_decode($requisitosEstancia->id_requisitos);
    
        // Obtener los registros de requisitos correspondientes a los IDs
        $id_requisitos = Requisitos::whereIn('id', $requisitosIds)->get();
    
        // Verificar si se encontraron requisitos
        if (!$id_requisitos) {
            abort(404, 'No se encontraron requisitos para la estancia.');
        }
    
    
        return view('user.createRequest', compact('estancia','id_requisitos'));
    }


    public function generarSolicitud(Request $request, $id)
    {
        $request->validate([
            // Aquí puedes agregar validaciones para los archivos subidos si es necesario
        ]);

        // Crear una nueva instancia de Solicitud y guardar los datos
        $solicitud = new Solicitudes();
        $solicitud->id_estancia = $id;
        $solicitud->email = $request->input('email');
        $solicitud->docente = auth()->user()->name; // Obtener el nombre del usuario autenticado
        $solicitud->fecha_solicitud = now()->toDateString();
        $solicitud->status = 0; // En revisión
        //$solicitud->save();

        // Obtener el ID recién creado de la solicitud
        $idSolicitud = $solicitud->id;

        // Procesar los archivos adjuntos y guardar sus rutas en un JSON
        $requisitosAdjuntos = [];
        for ($i = 1; $i <= 8; $i++) { // Cambia este rango según la cantidad de requisitos
            if ($request->hasFile('archivo_adjunto_' . $i)) {
                $archivo = $request->file('archivo_adjunto_' . $i);
                $nombreArchivo = $archivo->getClientOriginalName();
                $rutaArchivo = 'solicitudes/' . $idSolicitud . '/' . $nombreArchivo;
                $archivo->move(public_path('solicitudes/' . $idSolicitud), $nombreArchivo);
                $requisitosAdjuntos[] = $rutaArchivo;
            }
        }

        // Convertir el array de rutas en un JSON y guardarlo en la solicitud
        $solicitud->requisitos = json_encode($requisitosAdjuntos);
        $solicitud->save();

        // Redireccionar a la vista de éxito o a donde sea necesario
        return view('user.successRequest');
    }
    
    public function index()
    {
        $userId = Auth::user()->email;
        $solicitudes = Solicitudes::where('email', $userId)->get();

        return view('user.userSolicitudes', compact('solicitudes'));
    }


    public function showRequestFiles($id)
    {
        // Obtener la solicitud
        $solicitud = Solicitudes::findOrFail($id);

        // Obtener el JSON de requisitos de la tabla estanciaRequisitos
        $estanciaRequisitos = EstanciaRequisitos::where('id_estancia', $solicitud->id_estancia)->first();

        // Decodificar el JSON para obtener los ids de los requisitos
        $idsRequisitos = json_decode($estanciaRequisitos->id_requisitos);

        // Obtener los nombres de los requisitos de la tabla requisitos
        $requisitos = Requisitos::whereIn('id', $idsRequisitos)->get();
        // Decodificar el JSON de requisitos para obtener las rutas de archivos
        $rutasArchivos = json_decode($solicitud->requisitos);

        return view('user.showRequestFiles', compact('requisitos','rutasArchivos'));
    }

    public function currentRequests()
    {
        // Obtener todas las solicitudes con status diferente de 3
        $currentRequests = Solicitudes::where('status', '!=', 3)->get();

        // Retornar la vista con las solicitudes actuales
        return view('admi.currentRequests', compact('currentRequests'));
    }

    public function allRequests()
    {
        // Obtener todas las solicitudes
        $allRequests = Solicitudes::all();

        // Retornar la vista con todas las solicitudes
        return view('admi.allRequests', compact('allRequests'));
    }

    public function showRequest($id)
    {
        // Obtener la solicitud
        $solicitud = Solicitudes::findOrFail($id);

        // Obtener el JSON de requisitos de la tabla estanciaRequisitos
        $estanciaRequisitos = EstanciaRequisitos::where('id_estancia', $solicitud->id_estancia)->first();

        // Decodificar el JSON para obtener los ids de los requisitos
        $idsRequisitos = json_decode($estanciaRequisitos->id_requisitos);

        // Obtener los nombres de los requisitos de la tabla requisitos
        $requisitos = Requisitos::whereIn('id', $idsRequisitos)->get();
        // Decodificar el JSON de requisitos para obtener las rutas de archivos
        $rutasArchivos = json_decode($solicitud->requisitos);
        return view('admi.showRequest', compact('solicitud','requisitos', 'rutasArchivos'));
    }

    public function aceptarSolicitud($id)
    {
        // Encuentra la solicitud por su ID
        $solicitud = Solicitudes::findOrFail($id);

        // Actualiza el estado de la solicitud a 2 (Aceptado)
        $solicitud->status = 2;
        $solicitud->observaciones="Solicitud Aceptada.";
        $solicitud->save();

        // Redirige de vuelta a la misma página con un mensaje de éxito
        return view('admi.requestAccepted');
    }

    public function rechazarSolicitud($id)
    {
        // Encuentra la solicitud por su ID
        $solicitud = Solicitudes::findOrFail($id);

        // Actualiza el estado de la solicitud a 3 (Rechazado)
        $solicitud->status = 3;
        $solicitud->observaciones="Solicitud Rechazada.";
        $solicitud->save();

        // Redirige de vuelta a la misma página con un mensaje de éxito
        return view('admi.rejectRequest');
    }

}
