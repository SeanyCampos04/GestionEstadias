<x-app-layout class="py-0">
    <x-user-layout>
    </x-user-layout>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">   
                <div class="min-w-screen py-5 flex items-center justify-center">
                    <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div style="display: flex;">
                                <div style="flex: 1;">
                                    <h1>Requisitos de la Solicitud</h1>
                                    @foreach ($requisitos as $requisito)
                                        <p>{{ $requisito->nombre }}</p>
                                    @endforeach
                                </div>
                                <div style="flex: 1;">
                                    <h1>Archivos Adjuntos</h1>
                                    @foreach ($rutasArchivos as $ruta)
                                        @php
                                            $nombreArchivo = str_replace('solicitudes/', '', $ruta);
                                        @endphp
                                        <p><a href="{{ asset($ruta) }}">{{ $nombreArchivo }}</a></p>
                                    @endforeach
                                </div>
                                
                            </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('userSolicitudes') }}" class="inline-block bg-red-500 px-4 py-2 rounded-md text-white hover:bg-red-600">Regresar</a>
    </div>
</x-app-layout>
