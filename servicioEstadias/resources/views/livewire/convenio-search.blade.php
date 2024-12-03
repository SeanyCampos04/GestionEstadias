<div>
<div wire:loading wire:target="search" class="text-gray-500">
    Cargando resultados...
</div>
<input type="text" wire:model.defer="search" placeholder="Buscar convenios..." class="border p-2 rounded">
<br>
<div wire:poll.500ms>
    <br><table class="table">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-2">Empresa/Institución</th>
                    <th class="px-4 py-2">Fecha de Inicio</th>
                    <th class="px-4 py-2">Fecha de Vigencia</th>
                    <th class="px-4 py-2">Archivo</th>
                    <th class="px-4 py-2">Estado del Convenio</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($convenios as $convenio)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $convenio->nombre }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($convenio->fecha_inicio)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($convenio->fecha_vigencia)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ asset($convenio->archivo_convenio) }}" class="text-blue-500 hover:underline" target="_blank">
                                Ver archivo
                            </a>
                        </td>
                        <td class="px-4 py-2">
                            @if ($convenio->fecha_vigencia >= \Carbon\Carbon::today())
                                Convenio Vigente
                            @else
                                Convenio no Vigente
                            @endif
                        </td>
                        <td class="px-4 py-2">
                        <a href="{{ route('convenios.edit', $convenio->id) }}" class="text-blue-500 hover:underline">
                            Editar
                        </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No hay convenios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </div>
    </table>
</div>
</div>
