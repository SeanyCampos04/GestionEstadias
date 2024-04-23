<x-app-layout>
    <x-admin-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex flex-wrap justify-center">
                    <div class="w-3/4 px-6">
                        <div class="card">
                            <div class="card-header">
                                Editar Estancia
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('estancia.update', $estancia->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $estancia->nombre }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_convocatoria">Fecha de apertura convocatoria:</label>
                                        <input type="date" class="form-control" id="fecha_convocatoria" name="fecha_convocatoria" value="{{ $estancia->fecha_convocatoria }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_cierre">Fecha de cierre convocatoria:</label>
                                        <input type="date" class="form-control" id="fecha_cierre" name="fecha_cierre" value="{{ $estancia->fecha_cierre }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="periodo_duracion">Periodo de duración:</label>
                                        <input type="text" class="form-control" id="periodo_duracion" name="periodo_duracion" value="{{ $estancia->periodo_duracion }}">
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="requisitos">Requisitos:</label>
                                        <select multiple class="form-control" id="requisitos" name="requisitos[]">
                                            @foreach ($requisitos as $requisito)
                                                <option value="{{ $requisito->id }}">{{ $requisito->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>-->
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('adminDashboard') }}" class="btn btn-secondary">Cancelar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
</x-app-layout>

