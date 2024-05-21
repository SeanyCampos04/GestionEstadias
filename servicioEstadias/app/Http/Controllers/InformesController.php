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
        $solicitud = Solicitudes::where('email', $user->email)->where('status', 2)->firstOrFail();
        $estancia = Estancia::findOrFail($solicitud->id_estancia);
        

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
        $informes= Informe::all();
        return view('admi.showInformes', compact('informes'));
    }
}
