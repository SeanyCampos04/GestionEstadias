<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\Informe;
use App\Models\Solicitudes;
use App\Models\Estancia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InformesController extends Controller
{
    public function guardarInformes(Request $request)
    {
        // Validar archivos
        $request->validate([
            'constancia' => 'required|file|mimes:pdf|max:2048',
            'informe' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener la solicitud con status 2 del usuario autenticado
        $solicitud = Solicitudes::where('email', $user->email)
                        ->whereIn('status', [2, 5])
                        ->firstOrFail();
        $estancia = Estancia::findOrFail($solicitud->id_estancia);
        $solicitud->status=4;
        $solicitud->observaciones='Favor de esperar a la respuesta a su envío.';
        $solicitud->save();        

        // Crear registro en la base de datos
        $informe = new Informe();
        $informe->nombre = $user->name;
        $informe->id_solicitud = $solicitud->id;
        //$informe->save();

         // Crear directorio de almacenamiento en public
         $folderPath = public_path('Informes/' . $informe->id . '_' . $user->name);
         if (!File::exists($folderPath)) {
             File::makeDirectory($folderPath, 0755, true);
         }
 
         // Guardar archivo de constancia
         if ($request->hasFile('constancia')) {
             $constanciaPath = $folderPath . '/constancia_' . time() . '.pdf';
             $request->file('constancia')->move($folderPath, 'constancia_' . time() . '.pdf');
             $informe->ruta_constancia = 'Informes/' . $informe->id . '_' . $user->name . '/' . basename($constanciaPath);
         }
 
         // Guardar archivo de oficio
         if ($request->hasFile('informe')) {
             $oficioPath = $folderPath . '/oficio_' . time() . '.pdf';
             $request->file('informe')->move($folderPath, 'oficio_' . time() . '.pdf');
             $informe->ruta_oficio = 'Informes/' . $informe->id . '_' . $user->name . '/' . basename($oficioPath);
         }
 
         // Guardar registro en la base de datos
         $informe->save();

        return view('user.uploadInformesSuccess');
    }
    public function showInformes(){
        //$informes= Informe::all();
        $informes = Informe::with('solicitud.estancia')
        ->whereHas('solicitud', function ($query) {
            $query->where('status', 4)
                  ->orWhere('status', 5);
        })
        ->get();
        return view('admi.showInformes', compact('informes'));
    }

    public function aceptar($id)
    {
        // Encuentra la solicitud por su ID
        $solicitud = Solicitudes::findOrFail($id);

        // Actualiza el status y las observaciones
        $solicitud->status = 6;
        $solicitud->observaciones = 'Liberado Correctamente. Estancia Finalizada';
        $solicitud->save();

        // Redirige de vuelta a la vista de informes con un mensaje de éxito
        return redirect()->route('showInformes')->with('success', 'Informe aceptado y solicitud liberada.');
    }

    public function rechazarInforme($id)
{
    // Buscar la solicitud por ID
    $solicitud = Solicitudes::find($id);
    
    // Verificar si la solicitud existe
    if ($solicitud) {
        // Actualizar el estado y las observaciones
        $solicitud->status = 5;
        $solicitud->observaciones = "Detalles en archivos, favor de enviar informes finales de nuevo.";
        $solicitud->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('showInformes')->with('success', 'El informe ha sido rechazado.');
    } else {
        // Redirigir con un mensaje de error si no se encuentra la solicitud
        return redirect()->route('showInformes')->with('error', 'No se encontró la solicitud.');
    }
}
}
