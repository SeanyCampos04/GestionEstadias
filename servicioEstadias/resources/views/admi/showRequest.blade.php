<x-app-layout class="py-0">
    <x-admin-layout>
    </x-admin-layout>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">   
    <div class="min-w-screen py-5 flex items-center justify-center">
        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
            <h1 class="flex items-center justify-center text-3xl">Detalles de la Solicitud</h1>
            <table class="table w-full">
                <thead>
                    <tr>
                        <th class="text-2xl">Requisitos de la Solicitud</th>
                        <th class="text-2xl">Archivos Adjuntos</th>
                    </tr>
                </thead>
                <tbody>
                @if (!empty($rutasArchivos))
                @foreach ($requisitos as $index => $requisito)
                    <tr>
                        <td>{{ $requisito->nombre }}</td>
                        <td>
                            @if (is_array($rutasArchivos[$index]))
                                @foreach ($rutasArchivos[$index] as $archivo)
                                    <a class="text-blue-500 underline" href="{{ asset($archivo) }}">{{ $archivo }}</a><br>
                                @endforeach
                            @else
                                {{ $rutasArchivos[$index] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="2">No hay archivos adjuntos disponibles</td>
                </tr>
            @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
    <div class="text-center mt-4 flex justify-center">
    <form method="POST" action="{{ route('aceptar-solicitud', $solicitud->id) }}" class="mr-2">
        @csrf
        <button type="submit" class="bg-green-500 px-2 py-2 rounded-md text-white hover:bg-green-600">Aceptar</button>
    </form>
    <a href="{{ route('observaciones', $solicitud->id) }}" class="mr-2">
        <button class="bg-yellow-600 px-2 py-2 rounded-md text-white hover:bg-yellow-600">Observaciones</button>
    </a>
    <form method="POST" action="{{ route('rechazar-solicitud', $solicitud->id) }}" class="mr-2">
        @csrf
        <button type="submit" class="bg-red-500 px-2 py-2 rounded-md text-white hover:bg-red-600">Rechazar</button>
    </form>
    <a href="{{ route('solicitudes') }}">
        <button class="bg-gray-500 px-2 py-2 rounded-md text-white hover:bg-gray-600">Regresar</button>
    </a>
</div>


</x-app-layout>
<x-footer></x-footer>
