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

    // Crear una nueva instancia de Solicitud y asignar datos iniciales
    $solicitud = new Solicitudes();
    $solicitud->id_estancia = $id;
    $solicitud->email = $request->input('email');
    $solicitud->docente = auth()->user()->name; // Obtener el nombre del usuario autenticado
    $solicitud->fecha_solicitud = now()->toDateString();
    $solicitud->status = 0; // En revisión
    $solicitud->periodo_duracion = 'ad2024';
    $solicitud->requisitos = json_encode([]); // Inicializar el campo con un JSON vacío

    // Guardar la solicitud para generar el ID
    $solicitud->save();

    // Obtener el ID recién creado de la solicitud
    $idSolicitud = $solicitud->id;

    // Procesar los archivos adjuntos y guardar sus rutas en un JSON
    $requisitosAdjuntos = [];
    for ($i = 1; $i <= 8; $i++) { // Cambia este rango según la cantidad de requisitos
        if ($request->hasFile('archivo_adjunto_' . $i)) {
            $archivo = $request->file('archivo_adjunto_' . $i);
            $nombreArchivo = $archivo->getClientOriginalName();
            $rutaArchivo = 'solicitudes/' . $idSolicitud;

            // Crear el directorio si no existe
            if (!file_exists(public_path($rutaArchivo))) {
                mkdir(public_path($rutaArchivo), 0777, true);
            }

            // Mover el archivo al directorio
            $archivo->move(public_path($rutaArchivo), $nombreArchivo);

            // Agregar la ruta al array
            $requisitosAdjuntos[] = $rutaArchivo . '/' . $nombreArchivo;
        }
    }

    // Actualizar el campo requisitos con el JSON de rutas y guardar nuevamente
    $solicitud->requisitos = json_encode($requisitosAdjuntos);
    $solicitud->save();

    // Redireccionar a la vista de éxito o a donde sea necesario
    return view('user.successRequest');
}
    
    public function index()
    {
        $userId = Auth::user()->email;
        $solicitudes = Solicitudes::where('email', $userId)
        ->orderBy('status', 'asc')
        ->get();

        return view('user.userSolicitudes', compact('solicitudes'));
    }


    public function showRequestFiles($id)
    {
        $solicitud = Solicitudes::findOrFail($id);
        $estanciaRequisitos = EstanciaRequisitos::where('id_estancia', $solicitud->id_estancia)->first();
        $idsRequisitos = json_decode($estanciaRequisitos->id_requisitos);
        
        // Obtener los nombres de los requisitos
        $requisitos = Requisitos::whereIn('id', $idsRequisitos)->get();
        
        // Decodificar el campo requisitos y verificar que contenga arrays con clave 'archivo'
        $rutasArchivos = json_decode($solicitud->requisitos, true) ?? [];
        
        // Normalizar el array para asegurarnos de que todos tengan la clave 'archivo'
        $rutasArchivos = array_map(function($item) {
            return is_array($item) ? $item : ['archivo' => $item];
        }, $rutasArchivos);
    
        $rutasArchivos = array_pad($rutasArchivos, count($requisitos), ['archivo' => null]);
    
        return view('user.showRequestFiles', compact('requisitos', 'rutasArchivos', 'solicitud'));
    }
    

public function mostrarArchivo($id, $nombreArchivo)
{
    $rutaArchivo = public_path("solicitudes/{$id}/{$nombreArchivo}");
    
    // Verifica si el archivo existe antes de mostrarlo
    if (file_exists($rutaArchivo)) {
        return response()->file($rutaArchivo);
    } else {
        abort(404, 'Archivo no encontrado');
    }
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
        $allRequests = Solicitudes::paginate(10);

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
        $rutasArchivos = json_decode($solicitud->requisitos, true);

        $rutasArchivos = array_pad($rutasArchivos, count($requisitos), null);
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
    public function observaciones($id)
    {
        // Obtener la solicitud por su ID
        $solicitud = Solicitudes::findOrFail($id);

        // Devolver la vista de observaciones con los datos necesarios
        return view('admi.observaciones', compact('solicitud'));
    }
    
    public function enviarObservacion(Request $request, $id)
    {
        // Validar la solicitud y obtener los datos del formulario
        $request->validate([
            'observaciones' => 'required|string',
        ]);

        // Obtener la solicitud
        $solicitud = Solicitudes::findOrFail($id);

        // Actualizar la solicitud con las observaciones
        $solicitud->status=1;
        $solicitud->observaciones = $request->input('observaciones');

        // Guardar los cambios en la base de datos
        $solicitud->save();

        // Redirigir de vuelta a la página de la solicitud
        return view('admi.observationSent');
    }

    public function userUpdateRequest(Request $request, $id)
    {
        // Obtener la solicitud existente
        $solicitud = Solicitudes::findOrFail($id);
    
        // Decodificar el JSON de requisitos a un array
        $requisitosArray = json_decode($solicitud->requisitos, true);
    
        // Verificar si $requisitosArray es un array
        if (!is_array($requisitosArray)) {
            $requisitosArray = [];
        }
    
        // Procesar los archivos adjuntos y actualizar sus rutas en el JSON de requisitos
        foreach ($requisitosArray as $index => $requisito) {
            // Verificar si hay un nuevo archivo adjunto para este requisito
            if ($request->hasFile('nuevo_archivo_' . $index)) {
                $archivo = $request->file('nuevo_archivo_' . $index);
                $nombreArchivo = $archivo->getClientOriginalName();
                $rutaArchivo = 'solicitudes/' . $id . '/' . $nombreArchivo;
    
                // Eliminar el archivo anterior si existe
                if (isset($requisito['archivo']) && file_exists(public_path($requisito['archivo']))) {
                    unlink(public_path($requisito['archivo']));
                }
    
                // Mover el nuevo archivo a la carpeta de la solicitud
                $archivo->move(public_path('solicitudes/' . $id), $nombreArchivo);
    
                // Actualizar la ruta del archivo en el JSON de requisitos
                $requisitosArray[$index] = ['archivo' => $rutaArchivo];
            }
        }
    
        // Codificar el array de requisitos a JSON
        $requisitosJson = json_encode($requisitosArray);
    
        // Actualizar el campo requisitos en la solicitud
        $solicitud->requisitos = $requisitosJson;
    
        // Guardar la solicitud actualizada
        $solicitud->save();
    
        // Redireccionar o proporcionar alguna respuesta adecuada
        return redirect()->route('userSolicitudes')->with('success', 'Archivos actualizados correctamente.');
    }
    
    public function VinculacionShowRequest($id){
        $solicitud=Solicitudes::findOrFail($id);
        return view('vinculacion.showRequestVinculacion',compact('solicitud'));
    }
    public function validaConvenio($id){
        $solicitud=Solicitudes::findOrFail($id);
        $solicitud->status_convenio=2;

        $solicitud->save();
        return redirect()->route('vinculacionDashboard')-> with('success','Solicitud respondida correctamente');
    }
    public function rechazaConvenio($id){
        $solicitud=Solicitudes::findOrFail($id);
        $solicitud->status_convenio=1;
        $solicitud->status=3;

        $solicitud->save();
        return redirect()->route('vinculacionDashboard')-> with('success','Solicitud respondida correctamente');
    }
    public function convenioInexistente($id){
        $solicitud=Solicitudes::findOrFail($id);
        $solicitud->status_convenio=2; //Convenio inexistente
        $solicitud->status=0;//En revisión

        $solicitud->save();
        return redirect()->route('vinculacionDashboard')-> with('success','Solicitud respondida correctamente');
    }
}