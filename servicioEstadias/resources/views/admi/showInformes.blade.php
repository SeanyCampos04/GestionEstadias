<x-app-layout>
    <x-admin-layout></x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <div class="min-w-screen py-5 flex items-center justify-center">
                    <div class="bg-white text-gray-600 rounded-lg shadow-xl w-full">
                        <div class="overflow-x-auto">
                            <h1 class="text-2xl text-center py-4">Todos los Informes</h1>
                            <div class="card p-4">
                                <table class="min-w-full bg-white">
                                    <thead class=" text-black">
                                        <tr>
                                            <th class="w-1/4 py-2">Nombre</th>
                                            <th class="w-1/4 py-2">Constancia de liberación</th>
                                            <th class="w-1/4 py-2">Informe Final</th>
                                            <th class="w-1/4 py-2">ID Solicitud</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700">
                                        @foreach($informes as $informe)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $informe->nombre }}</td>
                                                <td class="border px-4 py-2"><a href="{{ ($informe->ruta_constancia) }}" target="_blank" class="text-blue-500 underline">Ver Constancia</a></td>
                                                <td class="border px-4 py-2"><a href="{{ Storage::url($informe->ruta_oficio) }}" target="_blank" class="text-blue-500 underline">Ver Informe</a></td>
                                                <td class="border px-4 py-2">{{ $informe->id_solicitud }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer></x-footer>
