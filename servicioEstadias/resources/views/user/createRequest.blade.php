<x-app-layout>
    <x-user-layout>

    </x-user-layout>
    <div class="py-12 w-full flex flex-wrap justify-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" w-full flex flex-wrap justify-center">
            <div class="w-3/4 px-6">
                <p>Para que su solicitud sea tomada en cuenta es necesario cumplir con los requisitos establecidos en la convocatoria y, a su vez, descargar, llenar con sus datos y subir cada uno de los archivos que se muestran a continuación.</p>
                <h3>Nombre de la estadía: {{ $estancia->nombre }}</h3>

                <form method="POST" action="{{ route('generar-solicitud', $estancia->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <input type="hidden" name="docente" value="{{ auth()->user()->name }}">
                    <input type="hidden" name="fecha_solicitud" value="{{ now()->toDateString() }}">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Num.</th>
                                <th>Nombre del Archivo</th>
                                <th>Descargar</th>
                                <th>Adjuntar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($id_requisitos as $requisito)
                            <tr>
                                <td>{{ $loop->iteration }}.-</td>
                                <td>{{ $requisito->nombre }}</td>
                                <td>
                                @if ($requisito->descargable == 1)
                                    <a href="{{ asset($requisito->archivo_requisito) }}" download>
                                        <img src="/images/download.png" alt="Descargar" width="29" height="29">
                                    </a>
                                @else
                                    No disponible para descarga
                                @endif
                            </td>

                                <td>
                                    <label for="file-input-{{ $loop->iteration }}">
                                        <img id="upload-icon-{{ $loop->iteration }}" src="/images/upload.jpg" alt="" width="50" height="50">
                                    </label>
                                    <input id="file-input-{{ $loop->iteration }}" type="file" name="archivo_adjunto_{{ $loop->iteration }}" style="display: none;" onchange="mostrarNombreArchivo('{{ $loop->iteration }}')">
                                    <span id="nombre-archivo-{{ $loop->iteration }}" style="display: none;"></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <b><p>Nota: Antes de enviar la solicitud verifique que haya añadido los documentos de TODOS los requisitos necesarios, de no ser así, su solicitud será rechazada automáticamente.</p></b>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                        <a href="{{ route('showUserEstancia', $estancia->id) }}" class="btn btn-secondary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function mostrarNombreArchivo(numero) {
        var fileInput = document.getElementById('file-input-' + numero);
        var uploadIcon = document.getElementById('upload-icon-' + numero);
        var nombreArchivo = document.getElementById('nombre-archivo-' + numero);

        if (fileInput.files.length > 0) {
            var nombre = fileInput.files[0].name;
            nombreArchivo.textContent = nombre;
            uploadIcon.style.display = 'none';
            nombreArchivo.style.display = 'inline-block';
        }
    }
</script>
</x-app-layout>