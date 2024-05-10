<x-app-layout>
    <x-user-layout></x-user-layout>

    @if($solicitud)
    <div class="flex items-center justify-center mt-8">
        <div class="card w-4/5 px-4 py-5">
            <div class="card-header flex items-center">
                <h1 class="text-center text-3xl w-full">Formulario para subida de Archivos</h1>
            </div>
            <div class="card-body form-control">
                <div class="form-group">
                    <label class="font-bold text-1xl" for="Constancia">Constancia de liberación:</label><br>
                    <input class="form-group" type="file" name="archivo1"><br> <br>
                </div>
                <label class="font-bold" for="informe">Informe Final:</label><br>
                <input type="file" name="archivo2"><br><br>
            </div>
            <p>Nota: Esta pestaña se encuentra habilitada sólo cuando usted se encuentre con una estancia en proceso.</p>
        </div>
    </div>
    @else
        Esta pestaña no está disponible, esto debido a que de momento no cuenta con estancias en proceso o Aceptadas.
    @endif

</x-app-layout>
<x-footer></x-footer>

