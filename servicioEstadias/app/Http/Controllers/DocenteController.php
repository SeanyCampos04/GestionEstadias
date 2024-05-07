<?php

namespace App\Http\Controllers;
use App\Models\User;
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
}
