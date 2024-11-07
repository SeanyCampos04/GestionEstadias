<x-app-layout>
    <x-admin-layout>    </x-admin-layout><br>
    <x-username-layout />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="min-w-screen py-5 flex items-center justify-center">
                        <div class="bg-white text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="overflow-x-auto px-6">
                                <h1 class="flex items-center justify-center text-3xl">Nueva Convocatoria</h1>
                                <form method="POST" action="{{ route('guardar-estancia') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre de la estancia:</label>
                                        <input type="text" id="nombre" name="nombre" class="form-input rounded-md w-full">
                                    </div>
                                    <div class="mb-4">
                                        <label for="empresa" class="block text-gray-700 font-bold mb-2">Empresa/Institución:</label>
                                        <input type="text" id="empresa" name="empresa" class="form-input rounded-md w-full">
                                    </div>
                                    <div class="mb-4">
                                        <label for="fecha_convocatoria" class="block text-gray-700 font-bold mb-2">Fecha de apertura convocatoria:</label>
                                        <input type="date" id="fecha_convocatoria" name="fecha_convocatoria" class="form-input rounded-md w-full">
                                    </div>
                                    <div class="mb-4">
                                        <label for="fecha_cierre" class="block text-gray-700 font-bold mb-2">Fecha de cierre de convocatoria:</label>
                                        <input type="date" id="fecha_cierre" name="fecha_cierre" class="form-input rounded-md w-full">
                                    </div>
                                    <div class="mb-4">
                                        <label for="archivo_convocatoria" class="block text-gray-700 font-bold mb-2">Convocatoria (PDF):</label>
                                        <input type="file" id="archivo_convocatoria" name="archivo_convocatoria" class="form-input rounded-md w-full">
                                    </div>
                                    <div class="mb-4 form-group">
                                        <label for="requisitos" class="block text-gray-700 font-bold mb-2">Seleccionar requisitos (CTRL + Click):</label>
                                        <select name="requisitos[]" id="requisitos" multiple class="form-multiselect rounded-md w-full py-6">
                                            @foreach($requisitos as $requisito)
                                            @if($requisito->nombre=='Convocatoria')
                                            @else
                                                <option value="{{ $requisito->id }}">{{$loop->iteration-1}}.- {{ $requisito->nombre }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group text-center">
                                        
                            
                                    <button type="submit" class="btn btn-primary">Crear</button>
                                    <input type="hidden" id="requisitos_json" name="requisitos_json">
                                    <a href="{{ route('adminDashboard') }}" class="btn btn-secondary">Regresar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
<x-footer></x-footer>