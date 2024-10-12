<x-app-layout>
    <x-vinculacion-layout>

    </x-vinculacion-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="flex py-12">
            <div class="w-full justify-center">
            <div class="py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif   
                        <div>
                                <h1 class="flex items-center justify-center text-3xl">Solicitudes pendientes</h1>
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
                                        @foreach ($estancias as $request)
                                        @if($request->status_convenio==2||$request->status_convenio==1)

                                        @else
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->docente }}</td>
                                                <td>{{ $request->email }}</td>
                                                <td>
                                                    @if($request->status==0)
                                                        En revisión
                                                    @elseif($request->status==1)
                                                    Otro 
                                                    @endif
                                                </td>
                                                <td>{{ $request->fecha_solicitud }}</td>
                                                <td>
                                                    <a class="text-blue-500" href="{{route('MostrarSolicitudVinculacion',$request->id)}}">Responder</a>
                                                </td>
                                            </tr>
                                            @endif
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
    <x-footer>
        
    </x-footer>
</x-app-layout>