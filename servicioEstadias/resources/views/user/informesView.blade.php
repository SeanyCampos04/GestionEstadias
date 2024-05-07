<x-app-layout>
    <x-user-layout></x-user-layout>
    
    <div class="container mx-auto py-5">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl font-bold mb-4 text-center">Archivos para estancia Aceptada</h1>
            
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Carta de Presentación</h2>
                <a href="{{ route('informes', $estancia->id) }}" class="text-blue-500 underline">Descargar</a>
            </div>
            
            <div class="text-center">
                <a href="{{ route('userSolicitudes') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Regresar</a>
            </div>
        </div>
    </div>
    
</x-app-layout>
<x-footer></x-footer>
