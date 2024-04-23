<x-app-layout>
    <x-admin-layout>

    </x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex flex-wrap justify-center">
                
                <div class="w-3/4 px-6">
                    <div class="card">
                        <div class="card-header">
                            Detalles de la Estancia
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('images/tec.jpg') }}" alt="Imagen de la estancia" class="img-fluid" height="250" width="250">
                            <hr>
                            <h5 class="card-title">Nombre: {{ $estancia->nombre }}</h5>
                            <hr>
                            <p class="card-text">Fecha de apertura de convocatoria: {{ $estancia->fecha_convocatoria }}</p>
                            <hr>
                            <p class="card-text">Fecha de cierre de convocatoria: {{ $estancia->fecha_cierre }}</p>
                            <hr>
                            <p class="card-text">Periodo de Duración: {{ $estancia->periodo_duracion }}</p>
                            <hr>
                            <p class="card-text">Archivo de Convocatoria:
                                <a href="{{ asset($estancia->archivo_convocatoria) }}" target="_blank">Ver PDF</a>
                            </p>
                        </div>
                        <div class="card-footer">
                        <a href="{{ route('estancia.edit', $estancia->id) }}" class="btn btn-success float-right">Editar</a>
                            <a href="{{ route('adminDashboard') }}" class="btn btn-primary float-right">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>