<x-app-layout>
    <x-user-layout>

    </x-user-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div class="w-full flex flex-wrap justify-center">
                    @foreach ($estancias as $estancia)
                    @if($estancia->vigente==1)
                    @else
                    <div class="card items-center mx-4 mb-4">
                        <img src="images/tec.jpg" alt="Imagen de la estancia" width="150" height="150">
                        <div class="card-body">
                            <h5 class="card-title">{{ $estancia->nombre }}</h5><br>
                            <p class="card-text">Fecha de apertura: {{ $estancia->fecha_convocatoria }}</p>
                            <p class="card-text">Fecha de cierre: {{ $estancia->fecha_cierre }}</p><br>
                            
                            <a href="{{ route('showUserEstancia', $estancia->id) }}" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
<x-footer></x-footer>
</x-app-layout>
