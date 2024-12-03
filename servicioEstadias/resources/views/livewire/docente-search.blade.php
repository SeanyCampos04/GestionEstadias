<div>
<div wire:loading wire:target="search" class="text-gray-500">
    Cargando resultados...
</div>
<input type="text" wire:model.defer="search" placeholder="Buscar docente" class="border p-2 rounded">
<br>
<div wire:poll.500ms>
<table class="table mt-4">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>RFC</th>
                <th>Nombramiento</th>
                <th>Academia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($docentes as $docente)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $docente->name }}</td>
                    <td>{{ $docente->email }}</td>
                    <td>{{ $docente->rfc }}</td>
                    <td>{{ $docente->nombramiento }}</td>
                    <td>{{ $docente->academia }}</td>
                    <td>
                                                    <a class="bg-green text-blue-500 underline" 
                                                    href="{{ route('docente.edit', $docente->id) }}">
                                                        Editar
                                                    </a>

                                                    <a href="#" class="text-red-500 underline ml-4" 
                                                    onclick="event.preventDefault(); 
                                                                if(confirm('¿Estás seguro de eliminar este docente?')) { 
                                                                    document.getElementById('delete-docente-{{ $docente->id }}').submit(); 
                                                                }">
                                                        Eliminar
                                                    </a>

                                                    <form id="delete-docente-{{ $docente->id }}" 
                                                        action="{{ route('docente.destroy', $docente->id) }}" 
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron resultados.</td>
                </tr>
            @endforelse
        </tbody>
        <div class="text-center mt-4">
    {{ $docentes->links() }}
</div>

    </table>
</div>