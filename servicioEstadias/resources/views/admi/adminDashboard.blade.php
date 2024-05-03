<x-app-layout>
<x-admin-layout>
    <x-slot name="header">
        <!-- Si necesitas un encabezado específico para esta vista, puedes definirlo aquí -->
    </x-slot>

</x-admin-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="w-full flex flex-wrap justify-center">
                
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