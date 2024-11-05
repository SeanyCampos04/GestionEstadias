<?php
use Carbon\Carbon;
?>
<x-app-layout>
    <x-user-layout>

    </x-user-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="flex justify-between py-12">
                <div class="w-full flex flex-wrap justify-center px-6 py-12">
                    @foreach ($estancias as $estancia)
                    @if($estancia->vigente==1)
                    @else
                    <div class="col-md-4 mb-4">
                    <div class="card mx-4 mb-4" style="height:400 px;">
                        <center><img src="images/tec.jpg" alt="Imagen de la estancia" width="200" height="200"></center>
                        <div class="card-body">
                            <h5 class="card-title p-2 text-2xl">{{ $estancia->nombre }}</h5><br>
                            <p class="card-text font-bold">Institución: <br> {{ $estancia->empresa }}</p>
                            <p class="card-text">Fecha de apertura: <br> {{ \Carbon\Carbon::parse($estancia->fecha_convocatoria)->format('d-m-Y') }}</p>
                            <p class="card-text">Fecha de cierre: <br>{{ \Carbon\Carbon::parse($estancia->fecha_cierre)->format('d-m-Y') }}</p><br>
                            
                            <div class="d-felx">
                            <a href="{{ route('showUserEstancia', $estancia->id) }}" class="btn btn-primary">Ver más</a>
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
<x-footer></x-footer>
</x-app-layout>
