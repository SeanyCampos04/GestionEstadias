<x-app-layout>
    <x-user-layout></x-user-layout>

    @if($solicitud)
    <div class="flex items-center justify-center mt-8">
        <div class="card w-4/5 px-4 py-5">
        <form method="POST" action="{{route('uploadinformes')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h1 class="text-2xl">Formulario para subida de Informes</h1>
                </div>
                <div class="card-body form-control">
                    <div class="form-group">
                        <label class="font-bold text-1xl" for="constancia">Constancia de liberación:</label><br>
                        <input class="form-group" type="file" name="constancia"><br><br>
                    </div>
                    <label class="font-bold" for="informe">Informe Final:</label><br>
                    <input type="file" name="informe"><br><br>
                </div>
                <input type="hidden" name="id_estancia" value="{{ $solicitud->id_estancia }}">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
            </form>
            <p>Nota: Esta pestaña se encuentra habilitada sólo cuando usted se encuentre con una estancia en proceso.</p>
        </div>
    </div>
    @else
        Esta pestaña no está disponible, esto debido a que de momento no cuenta con estancias en proceso o Aceptadas.
    @endif

</x-app-layout>
<x-footer></x-footer>

