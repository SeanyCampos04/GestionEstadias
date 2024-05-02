<div>
    <div>
        <nav class="bg-white shadow py-4">
            <div class="container mx-auto flex justify-between items-center">
                <h2 class="text-black text-xl">Sistema de Gestión de Estancias</h2>
                <div class="ml-auto flex space-x-4">
                    <a href="{{ route("adminDashboard") }}" class="text-black hover:text-gray-700">Mis Convocatorias</a>
                    <a href="{{ route("crearEstancia") }}" class="text-black hover:text-gray-700">Nueva Convocatoria</a>
                    <a href="{{ route("solicitudes") }}" class="text-black hover:text-gray-700">Solicitudes</a>
                    <div class="relative">
                        <button type="button" class="underline text-black hover:text-gray-700 focus:outline-none" onclick="toggleDropdown()">
                            Registros
                        </button>
                        <div id="dropdownMenu" class="absolute top-10 right-0 mt-2 bg-white border border-gray-300 rounded shadow-lg hidden">
                            <a href="{{ route('historico-solicitudes') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Histórico Solicitudes</a>
                            <a href="{{route('historico-convocatorias')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Histórico Convocatorias</a>
                            <a href="{{route('showUsers')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Registros de Usuarios</a>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-black hover:text-gray-700">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    {{ $slot }}
    <script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    }
</script>
</div>