<x-app-layout>
    <x-user-layout></x-user-layout>
    <div class="card py-5">
        <div class="card-header">
            <h1>Creado con exito.</h1>
        </div>
        <div class="card-body flex items-center justify-center">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
        </div>
    </div>
    
</x-app-layout>
<x-footer></x-footer>