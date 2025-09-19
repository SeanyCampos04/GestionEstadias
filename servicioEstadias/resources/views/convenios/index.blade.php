@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Convenios</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('convenios.create') }}">Registrar nuevo convenio</a>

    @if($convenios->count() > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 15px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha inicio</th>
                    <th>Fecha vigencia</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($convenios as $convenio)
                    <tr>
                        <td>{{ $convenio->id }}</td>
                        <td>{{ $convenio->nombre }}</td>
                        <td>{{ $convenio->fecha_inicio }}</td>
                        <td>{{ $convenio->fecha_vigencia }}</td>
                        <td>
                            @if($convenio->archivo_convenio)
                                <a href="{{ asset($convenio->archivo_convenio) }}" target="_blank">Ver PDF</a>
                            @else
                                Sin archivo
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('convenios.edit', $convenio->id) }}">Editar</a>
                            <!-- Si quieres agregar eliminar, puedes hacerlo con un form DELETE -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay convenios registrados.</p>
    @endif
</div>
@endsection
