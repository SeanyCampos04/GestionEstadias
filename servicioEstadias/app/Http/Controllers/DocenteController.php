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
        $docentes = User::where('id', '<>', 1)->paginate(10);
        $docente =User::findOrFail($id);
        
        // Actualizar los campos del docente
        //$docente->name = $request->input('name');
        //$docente->email = $request->input('email');
        $docente->rfc = $request->input('rfc');
        $docente->nombramiento = $request->input('nombramiento');
        //$docente->status = $request->input('status');
        $docente->curp = $request->input('curp');
        
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
        $estancias = Estancia::all(); 
        return redirect()->route('docente.edit', $docente->id)->with('success', 'Los cambios se guardaron correctamente.');

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

    public function destroy($id)
    {
        $estancias = Estancia::all();
        $docente = User::findOrFail($id);
        $docente->delete();

        return view('admi.adminDashboard',compact('estancias'))->with('success', 'Docente eliminado correctamente.');
    }

    public function create()
    {
        return view('admi.docenteCreate');
    }

    // Guardar un nuevo docente
    public function store(Request $request)
    {
        $estancias=Estancia::all();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email',
            'rfc' => 'required|string|max:13',
            'nombramiento' => 'required|string|max:255',
            'academia' => 'required|string|max:255',
            'password' => 'required|string|min:9',
        ]);
    
        // Crear un nuevo docente con la contraseña hasheada
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rfc' => $request->rfc,
            'nombramiento' => $request->nombramiento,
            'academia' => $request->academia,
            'password' => Hash::make($request->password), // Hasheamos la contraseña
        ]);

        // Redireccionar con mensaje de éxito
        return view('admi.adminDashboard', compact('estancias'))
                         ->with('success', 'Docente registrado exitosamente.');
    }
}
