<x-app-layout>
    <x-admin-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="min-w-screen py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="overflow-x-auto">
                                <h1>Nueva Convocatoria</h1>
                                <form method="POST" action="{{ route('guardar-estancia') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre de la estadía:</label>
                                        <input type="text" id="nombre" name="nombre" class="form-input rounded-md w-2/4">
                                    </div>
                                    <div class="mb-4">
                                        <label for="fecha_convocatoria" class="block text-gray-700 font-bold mb-2">Fecha de apertura convocatoria:</label>
                                        <input type="date" id="fecha_convocatoria" name="fecha_convocatoria" class="form-input rounded-md w-2/4">
                                    </div>
                                    <div class="mb-4">
                                        <label for="fecha_cierre" class="block text-gray-700 font-bold mb-2">Fecha de cierre de convocatoria:</label>
                                        <input type="date" id="fecha_cierre" name="fecha_cierre" class="form-input rounded-md w-2/4">
                                    </div>
                                    <div class="mb-4">
                                        <label for="periodo_duracion" class="block text-gray-700 font-bold mb-2">Periodo de duración:</label>
                                        <input type="text" id="periodo_duracion" name="periodo_duracion" class="form-input rounded-md w-2/4">
                                    </div>
                                    <div class="mb-4">
                                        <label for="archivo_convocatoria" class="block text-gray-700 font-bold mb-2">Convocatoria (PDF):</label>
                                        <input type="file" id="archivo_convocatoria" name="archivo_convocatoria" class="form-input rounded-md w-2/4">
                                    </div>
                                    <div class="mb-4">
                                        <label for="requisitos" class="block text-gray-700 font-bold mb-2">Seleccionar requisitos (CTRL + Click):</label>
                                        <select name="requisitos[]" id="requisitos" multiple class="form-multiselect rounded-md w-2/4 py-6">
                                            @foreach($requisitos as $requisito)
                                                <option value="{{ $requisito->id }}">{{$requisito->id}}.- {{ $requisito->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Crear</button>
                                    <input type="hidden" id="requisitos_json" name="requisitos_json">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
</x-app-layout>
