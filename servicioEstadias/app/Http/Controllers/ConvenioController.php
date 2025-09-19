<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;
class ConvenioController extends Controller
{
    public function showConvenios(){
        $convenios=Convenio::all();
        return view('vinculacion.showConvenios', compact('convenios'));
    }

    public function create()
    {
        return view('vinculacion.createConvenio');
    }

    public function store(Request $request)
    {
        $convenios=Convenio::orderBy('fecha_vigencia');
        // el tamaño máximo aquí es en kilobytes un ejemplo 5120 KB = 5 MB).
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_vigencia' => 'required|date',
            'archivo_convenio' => 'required|file|mimes:pdf|max:5120',
        ]);

        $convenio = Convenio::create([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_vigencia' => $request->fecha_vigencia,
            'archivo_convenio' => '',
        ]);

        if ($request->hasFile('archivo_convenio')) {
            $archivo = $request->file('archivo_convenio');
            $nombreArchivo = $archivo->getClientOriginalName();
            $rutaCarpeta = 'convenios/' . $convenio->id;
            $rutaArchivo = $rutaCarpeta . '/' . $nombreArchivo;

            $archivo->move(public_path($rutaCarpeta), $nombreArchivo);

            $convenio->update(['archivo_convenio' => $rutaArchivo]);
        }

    return redirect()->route('showConvenios')->with('success', 'Convenio creado exitosamente.');
    }

    public function edit($id)
    {
        $convenio = Convenio::findOrFail($id);
        return view('vinculacion.editConvenio', compact('convenio'));
    }

    public function update(Request $request, $id)
    {
        $convenios=Convenio::orderBy('fecha_vigencia');
        $convenio = Convenio::findOrFail($id);

        // Ver nota sobre php.ini en el método store
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_vigencia' => 'required|date',
            'archivo_convenio' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $convenio->nombre = $request->input('nombre');
        $convenio->fecha_inicio = $request->input('fecha_inicio');
        $convenio->fecha_vigencia = $request->input('fecha_vigencia');

        if ($request->hasFile('archivo_convenio')) {
            if ($convenio->archivo_convenio && file_exists(public_path($convenio->archivo_convenio))) {
                unlink(public_path($convenio->archivo_convenio));
            }

            $archivo = $request->file('archivo_convenio');
            $nombreArchivo = $archivo->getClientOriginalName();
            $rutaArchivo = "convenios/{$convenio->id}/{$nombreArchivo}";
            $archivo->move(public_path("convenios/{$convenio->id}/"), $nombreArchivo);

            $convenio->archivo_convenio = $rutaArchivo;
        }

        $convenio->save();

    return redirect()->route('showConvenios')->with('success', 'Convenio actualizado correctamente.');
    }



}
