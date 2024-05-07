<x-app-layout>
    <x-admin-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="min-w-screen py-5 flex items-center justify-center">
                        <div class="bg-gray-200 text-gray-600 rounded-lg shadow-xl w-full">
                            <div class="card">
                            <div class="overflow-x-auto">
                                <div class="card-header">
                                    <h1 class="text-center text-3xl">Lista de Docentes</h1>
                                </div>
                                <div class="card-body">
                                <form method="POST" action="{{route('docente.update', $docente->id)}}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Nombre:</label>
                                        <input class="form-control rounded" type="text" id="name" name="name" value="{{ $docente->name }}" disabled>
                                    </div>
                                        <br>
                                    <div class="form-group">
                                        <label for="email">Correo:</label>
                                        <input class="form-control rounded" type="text" id="email" name="email" value="{{ $docente->email }}" disabled>
                                    </div>
                                        <br>
                                    <div class="form-group">
                                        <label for="rfc">RFC:</label>
                                        <input class="form-control rounded" type="text" id="rfc" name="rfc" value="{{ $docente->rfc }}" >
                                    </div>
                                        <br>
                                    <div class="form-group">
                                        <h4><label for="nombramiento">Nombramiento:</label></h4>
                                        <input class="form-control rounded" type="text" id="nombramiento" name="nombramiento" value="{{ $docente->nombramiento }}" >
                                    </div>
                                        <br>
                                        <label for="rfc">Academia:</label>
                                        <input class="form-control rounded" type="text" id="academia" name="academia" value="{{ $docente->academia }}" >
                                        <br><br>
                                        <label for="password">Contraseña Actual:</label>
                                        <input class="form-control rounded" type="password" id="password" name="password" value="{{ $docente->password }}" disabled>
                                    <br>
                                    <label for="new_password">Nueva Contraseña:</label>
                                    <input class="form-control rounded" type="password" id="new_password" name="new_password">
                                        <br>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        <a href="{{ route('showUsers') }}" class="btn btn-secondary">Regresar</a>

                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
</x-app-layout>
<x-footer></x-footer>