<x-app-layout>
    <x-user-layout>

    </x-user-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="min-w-screen py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="overflow-x-auto">
                            <h1 class="flex items-center justify-center text-2xl">Mis solicitudes</h1>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Estancia</th>
                                            <th>Fecha de Solicitud</th>
                                            <th>Status</th>
                                            <th>Observaciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($solicitudes as $solicitud)
                                            <tr>
                                                <td>{{ $solicitud->id }}</td>
                                                <td>{{ $solicitud->estancia->nombre }}</td>
                                                <td>{{ $solicitud->fecha_solicitud }}</td>
                                                <td>
                                                    @if ($solicitud->status == 0)
                                                        En revisión
                                                    @elseif ($solicitud->status == 1)
                                                        Acciones necesarias
                                                    @elseif ($solicitud->status == 2)
                                                        Aceptado
                                                    @elseif ($solicitud->status == 3)
                                                        Rechazado
                                                    @else
                                                        Estado desconocido
                                                    @endif
                                                </td>
                                                <td>{{$solicitud->observaciones}}</td>
                                                <td>
                                                    @if ($solicitud->status == 0 || $solicitud->status == 1)
                                                        <a class="text-blue-500 underline" href="{{ route('showRequestFiles', $solicitud->id) }}">Editar Solicitud</a>
                                                    @elseif ($solicitud->status ==2)
                                                    <a class="text-blue-500 underline" href="{{route('informesView',$solicitud->estancia->id)}}">Ver Más</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="flex items-center justify-center w-full">
                                    <a href="{{ route('dashboard') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Regresar</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-app-layout>
<x-footer></x-footer>