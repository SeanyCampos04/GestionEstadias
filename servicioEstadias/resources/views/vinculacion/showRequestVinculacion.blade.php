<x-app-layout>
    <x-vinculacion-layout>

    </x-vinculacion-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="flex py-12">
            <div class="w-full justify-center">
            <div class=" py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="justify-center">
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
                                    
                                            <tr>
                                                <td>{{ $solicitud->id }}</td>
                                                <td>{{ $solicitud->docente }}</td>
                                                <td>{{ $solicitud->email }}</td>
                                                <td>
                                                    @if($solicitud->status==0)
                                                        En revisión
                                                    @elseif($solicitud->status==1)
                                                    Otro 
                                                    @endif
                                                </td>
                                                <td>{{ $solicitud->fecha_solicitud }}</td>
                                                <td class="flex space x-2"> <form method="POST" action="{{ route('valida_convenio', $solicitud->id) }}" class="mr-1">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 px-2 py-2 rounded-md text-white hover:bg-green-600">Aceptar</button>
                                                     </form>
                                                    <form method="POST" action="{{ route('rechaza_convenio', $solicitud->id) }}" class="mr-1">
                                                        @csrf
                                                        <button type="submit" class="bg-red-500 px-1 py-2 rounded-md text-white hover:bg-red-600">Rechazar</button>
                                                     </form>
                                                   
                                                </td>
                                            </tr>
                                       
                                    </tbody>
                                  
                                </table>
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('vinculacionDashboard') }}">
                                        <button class="bg-gray-500 px-2 py-2 rounded-md text-white hover:bg-gray-600">Regresar</button>
                                    </a>
                                </div>
                            </div>
                           
                        </div> <br>
                        
                    </div>
                    
            </div>
            
        </div>
        </div>
    </div>
    <x-footer>
        
    </x-footer>
</x-app-layout>