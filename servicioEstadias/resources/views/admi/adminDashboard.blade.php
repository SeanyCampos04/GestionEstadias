<x-app-layout>
<x-admin-layout>
    <x-slot name="header">

    </x-slot>

</x-admin-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="w-full flex flex-wrap justify-center">
            @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Éxito!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Cerrar</title>
                                <path d="M14.348 14.849a.5.5 0 0 1-.708 0L10 10.707l-3.64 3.642a.5.5 0 1 1-.708-.708l3.64-3.641-3.64-3.64a.5.5 0 1 1 .708-.708l3.64 3.64 3.64-3.64a.5.5 0 1 1 .708.708L10.707 10l3.641 3.64a.5.5 0 0 1 0 .708z"/>
                            </svg>
                        </span>
                    </div>
                @endif
                <div class="w-3/4 px-6">
                    <div class="row">
                        @foreach ($estancias as $estancia)
                        @if ($estancia->vigente == 0)
                            <div class="col-md-4 mb-4">
                                <div class="card" style="height: 400px;">
                                    <center><img src="images/tec.jpg" alt="Imagen de la estancia" width="200" height="200"></center>
                                    <div class="card-body">
                                        <h5 class="card-title p-2 text-2xl">{{ $estancia->nombre }}</h5>
                                        <p class="card-text">Fecha de apertura: <br> {{ $estancia->fecha_convocatoria }}</p>
                                        <p class="card-text">Fecha de cierre: <br> {{ $estancia->fecha_cierre }}</p><br>
                                        <div class="d-flex">
                                            <a href="{{ route('verEstancia', $estancia->id) }}" class="btn btn-primary mr-2" style="height:40px;">Ver</a>
                                            <form action="{{ route('eliminar-estancia', $estancia->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ocultar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<x-footer></x-footer>