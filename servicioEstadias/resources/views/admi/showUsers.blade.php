<x-app-layout>
    <x-admin-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="min-w-screen py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="overflow-x-auto">
                                <h1 class="text-center text-3xl">Lista de Docentes</h1>
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>RFC</th>
                                            <th>Nombramiento</th>
                                            <th>Academia</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($docentes as $docente)
                                        @if($docente->id==1)
                                        @else
                                            <tr>
                                                <td>{{ $docente->id }}</td>
                                                <td>{{ $docente->name }}</td>
                                                <td>{{ $docente->email }}</td>
                                                <td>{{ $docente->rfc }}</td>
                                                <td>{{ $docente->nombramiento }}</td>
                                                <td>{{ $docente->academia }}</td>
                                                <td><a class="text-blue-500 underline" href="{{ route('docente.edit', $docente->id) }}"> Editar</a></td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
</x-app-layout>
<x-footer></x-footer>