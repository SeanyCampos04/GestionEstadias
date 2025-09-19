@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Convenio</h1>

    <form action="{{ route('convenios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Nombre de la empresa/institución</label>
            <input type="text" name="nombre" required>
        </div>

        <div>
            <label>Fecha de inicio</label>
            <input type="date" name="fecha_inicio" required>
        </div>

        <div>
            <label>Fecha de vigencia</label>
            <input type="date" name="fecha_vigencia" required>
        </div>

        <div>
            <label>Archivo del convenio</label>
            <input type="file" name="archivo_convenio" required>
        </div>

        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
