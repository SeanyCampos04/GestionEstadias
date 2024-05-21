<x-app-layout>
    <x-admin-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="min-w-screen py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="overflow-x-auto">
                                <h1 class="flex items-center justify-center text-3xl">Solicitudes Recientes</h1>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Docente</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Fecha de Solicitud</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentRequests as $request)
                                            @if($request->status==2)
                                            @elseif($request->status==3)
                                            @elseif($request->status==4)
                                            @elseif($request->status==5)
                                            @elseif($request->status==6)
                                            @else
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->docente }}</td>
                                                <td>{{ $request->email }}</td>
                                                <td>
                                                    @if($request->status==0)
                                                        En revisión
                                                    @elseif($request->status==1)
                                                        Observaciones realizadas, en espera de respuesta
                                                        
                                                    @endif
                                                </td>
                                                <td>{{ $request->fecha_solicitud }}</td>
                                                <td>
                                                    <a href="{{ route('admiShowRequest', $request->id) }}" class="text-blue-500 hover:text-blue-700">Ver Solicitud</a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group text-center">
                                        <a href="{{ route('adminDashboard') }}" class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
</x-app-layout>
<x-footer></x-footer>