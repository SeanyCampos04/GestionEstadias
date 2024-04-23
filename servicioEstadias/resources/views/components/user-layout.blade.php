<div>
    <div>
        <nav class="bg-white shadow py-4">
            <div class="container mx-auto flex justify-between items-center">
                <h2 class="text-black text-xl">Sistema de Gestión de Estancias</h2>
                <div class="ml-auto flex space-x-4">
                    <a href="{{ route("dashboard") }}" class="text-black hover:text-gray-700">Convocatorias</a>
                    <a href="{{ route("userSolicitudes") }}" class="text-black hover:text-gray-700">Solicitudes</a>
                    <a href="{{ route("profile.edit") }}" class="text-black hover:text-gray-700">Mi Perfil</a>
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