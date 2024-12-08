<div>
    <div>
        <nav class="bg-white shadow py-4">
            <div class="container mx-auto flex justify-between items-center">
            <div class="p-4 px-1 py-1">
                <x-title></x-title>
                </div>
                <div class="ml-auto flex space-x-4">
                    <a href="{{route('vinculacionDashboard')}}" class="text-black hover:text-gray-700 underline">Solicitudes</a>
                    <a href="{{route('showConvenios')}}" class="text-black hover:text-gray-700 underline">Convenios</a>
                    <a href="{{ route("profile.edit") }}" class="text-black hover:text-gray-700 underline">Mi Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-black hover:text-gray-700 underline">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    {{ $slot }}
</div>