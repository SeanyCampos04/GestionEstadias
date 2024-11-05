<?php
use Carbon\Carbon;
?>
<x-app-layout>
    <x-vinculacion-layout>

    </x-vinculacion-layout>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="flex py-12">
            <div class="w-full justify-center">
                <div class="flex flex-col items-center space-y-4">
                    <h1 class="text-3xl font-bold text-center">Detalles de la Solicitud</h1>

                   
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full max-w-lg p-6">
                        <center><img src="images/teclogo.jpg" alt="" width="200" height="200"></center>
                        <div class="bg-white">
                                <h2 class="text-xl font-semibold mb-2">Solicitante: {{$solicitud->docente}}</h2>
                                <p><strong>Empresa/Institución:</strong> {{ $solicitud->empresa }}</p>
                                <p><strong>Email:</strong> {{ $solicitud->email }}</p>
                                <p><strong>Fecha de Solicitud:</strong> {{ \Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d-m-Y') }}</p>
                                <p><strong>Status:</strong> 
                                    @if($solicitud->status == 0)
                                        En revisión
                                    @elseif($solicitud->status == 1)
                                        Otro
                                    @endif
                                </p>
                            </div>
                            <div class="flex space-x-2 mt-4">
                                <form method="POST" action="{{ route('valida_convenio', $solicitud->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-green-500 px-4 py-2 rounded-md text-white hover:bg-green-600">Aceptar</button>
                                </form>

                                <form method="POST" action="{{ route('rechaza_convenio', $solicitud->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-red-500 px-4 py-2 rounded-md text-white hover:bg-red-600">Rechazar</button>
                                </form>
                            </div>
                        </div>

                    <div class="flex items-center justify-center mt-6">
                        <a href="{{ route('vinculacionDashboard') }}">
                            <button class="bg-gray-500 px-4 py-2 rounded-md text-white hover:bg-gray-600">Regresar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <x-footer>
        
    </x-footer>
</x-app-layout>