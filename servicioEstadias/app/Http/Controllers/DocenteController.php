<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Estancia;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function edit($id)
    {
        $docente = User::findOrFail($id);
        return view('admi.docenteEdit', ['docente' => $docente]);
    }

    public function update(Request $request, $id)
    {
        $docente =User::findOrFail($id);
        
        // Actualizar los campos del docente
        //$docente->name = $request->input('name');
        //$docente->email = $request->input('email');
        $docente->rfc = $request->input('rfc');
        $docente->nombramiento = $request->input('nombramiento');
        //$docente->status = $request->input('status');
        $docente->academia = $request->input('academia');
        
        // Verificar si se proporcionó una nueva contraseña
        if ($request->filled('new_password')) {
            // Obtener la nueva contraseña del request
            $newPassword = $request->input('new_password');
            // Cifrar la nueva contraseña
            $hashedPassword = Hash::make($newPassword);
            // Guardar la nueva contraseña cifrada en el modelo
            $docente->password = $hashedPassword;
        }
        
        // Guardar los cambios en la base de datos
        $docente->save();
        return view('admi.docenteUpdateSuccess', ['docente' => $docente]);
        // Redirigir a alguna vista después de guardar los cambios
    }
    public function verArchivos($id){
        $estancia = Estancia::findOrFail($id);
        return view('user.informesView',compact('estancia'));
    }

    public function generarInforme($id)
    {
        $docente = Auth::user();
        $estancia = Estancia::findOrFail($id);
        $html = view('user.informe', compact('docente', 'estancia'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->render();
        return $dompdf->stream('carta_presentacion.pdf');
    }

    public function enableInformes(){
        $email = Auth::user()->email;

    $solicitud = Solicitudes::where('email', $email)
                            ->whereIn('status', [2, 5])
                            ->latest()
                            ->first();

    // Determinar si los campos deben estar habilitados
    $camposHabilitados = $solicitud && $solicitud->status != 4;

    return view('user.enableInformes', compact('solicitud', 'camposHabilitados'));

    }
    
}
