<x-app-layout>
    <x-vinculacion-layout></x-vinculacion-layout><br>
    <x-username-layout /><br>

    @if (session('success'))
    <br>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Cerrar</title>
                    <path d="M14.348 14.849a.5.5 0 0 1-.708 0L10 10.707l-3.64 3.642a.5.5 0 1 1-.708-.708l3.64-3.641-3.64-3.64a.5.5 0 1 1 .708-.708l3.64 3.64 3.64-3.64a.5.5 0 1 1 .708.708L10.707 10l3.641 3.64a.5.5 0 0 1 0 .708z"/>
                </svg>
            </span>
        </div>
    @endif
    <div class="container mx-auto py-8"><br>
        <h1 class="text-2xl font-bold text-center mb-6">Lista de Convenios</h1>
        <div class="mb-4 flex justify-end">
            <a href="{{ route('convenios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Añadir Nuevo Convenio
            </a>
        </div>
        <table class="table">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-2">Empresa/Institución</th>
                    <th class="px-4 py-2">Fecha de Inicio</th>
                    <th class="px-4 py-2">Fecha de Vigencia</th>
                    <th class="px-4 py-2">Archivo</th>
                    <th class="px-4 py-2">Estado del Convenio</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($convenios as $convenio)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $convenio->nombre }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($convenio->fecha_inicio)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($convenio->fecha_vigencia)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ asset($convenio->archivo_convenio) }}" class="text-blue-500 hover:underline" target="_blank">
                                Ver archivo
                            </a>
                        </td>
                        <td class="px-4 py-2">
                            @if ($convenio->fecha_vigencia >= \Carbon\Carbon::today())
                                Convenio Vigente
                            @else
                                Convenio no Vigente
                            @endif
                        </td>
                        <td class="px-4 py-2">
                        <a href="{{ route('convenios.edit', $convenio->id) }}" class="text-blue-500 hover:underline">
                            Editar
                        </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No hay convenios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</x-app-layout>
<x-footer></x-footer>