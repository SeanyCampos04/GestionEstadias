<x-app-layout class="py-0">
    <x-admin-layout>
    </x-admin-layout>
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
        <form method="POST" action="{{ route('aceptar-solicitud', $solicitud->id) }}">
            @csrf
            <button type="submit" class="inline-block bg-green-500 px-2 py-2 rounded-md text-white hover:bg-green-600">Aceptar</button>
        </form>
        <button class="inline-block bg-yellow-500 px-2 py-2 rounded-md text-white hover:bg-yellow-600 mr-2">Observaciones</button>
        <form method="POST" action="{{ route('rechazar-solicitud', $solicitud->id) }}">
            @csrf
            <button type="submit" class="inline-block bg-red-500 px-2 py-2 rounded-md text-white hover:bg-red-600">Rechazar</button>
        </form>
        <a href="{{ route('solicitudes') }}" class="inline-block bg-gray-500 px-2 py-2 rounded-md text-white hover:bg-gray-600">Regresar</a>
</div>

</x-app-layout>

