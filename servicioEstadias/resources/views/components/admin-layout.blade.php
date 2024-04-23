<div>
    <div>
        <nav class="bg-white shadow py-4">
            <div class="container mx-auto flex justify-between items-center">
                <h2 class="text-black text-xl">Sistema de Gestión de Estancias</h2>
                <div class="ml-auto flex space-x-4">
                    <a href="{{ route("adminDashboard") }}" class="text-black hover:text-gray-700">Mis Convocatorias</a>
                    <a href="{{ route("crearEstancia") }}" class="text-black hover:text-gray-700">Nueva Convocatoria</a>
                    <a href="{{ route("solicitudes") }}" class="text-black hover:text-gray-700">Solicitudes</a>
                    <a href="{{ route('historico-solicitudes') }}" class="text-black hover:text-gray-700">Histórico Solicitudes</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-black hover:text-gray-700">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    {{ $slot }}
</div>