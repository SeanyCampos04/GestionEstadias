<x-app-layout>
    <x-admin-layout></x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <div class="min-w-screen py-5 flex items-center justify-center">
                    <div class="bg-white text-gray-600 rounded-lg shadow-xl w-full">
                    @if(session('success'))
                            <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
                                <p class="font-bold">Éxito</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
                                <p class="font-bold">Error</p>
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        @endif
                        <div class="overflow-x-auto">
                            <h1 class="text-2xl text-center py-4">Informes en espera de respuesta</h1>
                            <div class="card p-4">
                                <table class="min-w-full bg-white">
                                    <thead class="text-black-500">
                                        <tr>
                                            <th class="w-1/4 py-2">Nombre</th>
                                            <th class="w-1/4 py-2">Nombre Estancia</th>
                                            <th class="w-1/4 py-2">Constancia de Liberación</th>
                                            <th class="w-1/4 py-2">Informe Final</th>
                                            <th class="w-1/4 py-2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700">
                                        @foreach($informes as $informe)
                                            @if($informe->solicitud->status ==5)
                                            @else
                                            <tr>
                                                <td class="border px-4 py-2">{{ $informe->nombre }}</td>
                                                <td class="border px-4 py-2">{{ $informe->solicitud->estancia->nombre }}</td>
                                                <td class="border px-4 py-2">
                                                    <a href="{{ url($informe->ruta_constancia) }}" target="_blank" class="text-blue-500 underline">
                                                        Descargar Constancia
                                                    </a>
                                                </td>
                                                <td class="border px-4 py-2">
                                                    <a href="{{ url($informe->ruta_oficio) }}" target="_blank" class="text-blue-500 underline">
                                                        Descargar Informe
                                                    </a>
                                                </td>
                                               <td>
                                               <form method="POST" action="{{ route('aceptar.informe', $informe->solicitud->id) }}">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded">Aceptar</button>
                                                </form>
                                                <form method="POST" action="{{ route('rechazar.informe', $informe->solicitud->id) }}">
                                                        @csrf
                                                        <button class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded mt-2">Rechazar</button>
                                                </form>
                                                
                                               </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group text-center py-3">
                                        <a href="{{ route('adminDashboard') }}" class="btn btn-secondary">Regresar</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer></x-footer>
