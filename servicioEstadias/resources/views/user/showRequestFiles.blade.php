<x-app-layout class="py-0">
    <x-user-layout>
    </x-user-layout>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">   
            <div class="min-w-screen py-5 flex items-center justify-center">
                <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                    <h1 class="flex items-center justify-center text-2xl">Archivos de la Solicitud</h1>
                    <form method="POST" action="{{ route('userUpdateRequest',$solicitud->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')    
                    <table class="table">
                        <thead>
                            <th>Nombre del Requisito</th>
                            <th>Archivo Adjunto</th>
                            <th>Nuevo Archivo</th>
                            <th>Acciones</th>
                        </thead>
                        
                        @foreach ($requisitos as $index => $requisito)
                        <tr>
                                <td class="border px-4 py-2">{{ $requisito->nombre }}</td>
                                <td class="border px-4 py-2">
                                    <a class="text-blue-500 underline" href="{{ asset($rutasArchivos[$index]) }}">{{ str_replace('solicitudes/', '', $rutasArchivos[$index]) }}</a>
                                </td>
                                <td class="border px-4 py-2" id="file_display_{{ $index }}"></td>
                                <td>
                                    <label for="file_{{ $index }}" class="text-blue-500 underline cursor-pointer">Modificar</label>
                                    <input type="file" id="file_{{ $index }}" class="hidden" onchange="updateFileName(this, 'file_display_{{ $index }}')" name="nuevo_archivo_{{ $index }}">
                                </td>
                            </tr>
                        @endforeach
                        </table>
                        <button type="submit" class="inline-block bg-green-500 px-4 py-2 rounded-md text-white hover:bg-green-600 ml-4">Guardar cambios</button>
                    </form>
                    <p class="text-red-500">Nota: En caso de requerir modificar alguno de los archivos, tenga en cuenta que los nuevos archivos deben ser también en formato PDF, de lo contrario no se podrán guardar los cambios.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('userSolicitudes') }}" class="inline-block bg-gray-500 px-4 py-2 rounded-md text-white hover:bg-red-600">Regresar</a>
    </div>
</x-app-layout>
<x-footer></x-footer>

<script>
    function updateFileName(input, displayId) {
        const display = document.getElementById(displayId);
        if (input.files.length > 0) {
            display.innerText = input.files[0].name;
        }
    }
</script>