<x-app-layout>
    <x-admin-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="min-w-screen py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="overflow-x-auto">
                            <h1 class="text-center text-3xl">Historial de Estancias</h1>
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Archivo de Convocatoria</th>
                                        <th>Vigente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estancias as $estancia)
                                        <tr>
                                            <td>{{ $estancia->id }}</td>
                                            <td>{{ $estancia->nombre }}</td>
                                            <td>
                                                    <a class="text-blue-500 underline" href="{{ asset('' . $estancia->archivo_convocatoria) }}" target="_blank">Ver Archivo</a>
                                                
                                            </td>
                                            <td>
                                                @if($estancia->vigente==0)
                                                    Vigente
                                                @else
                                                    Terminada
                                                @endif
                                            </td>
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
    </x-admin-layout>
</x-app-layout>
<x-footer></x-footer>