<x-app-layout>
    <x-admin-layout><br>
    <x-username-layout />
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h1 class="text-2xl font-bold mb-6">Registrar Nuevo Docente</h1>

                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('docente.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                            <input type="email" name="email" id="email" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="rfc" class="block text-sm font-medium text-gray-700">RFC</label>
                            <input type="text" name="rfc" id="rfc" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="nombramiento" class="block text-sm font-medium text-gray-700">Nombramiento</label>
                            <input type="text" name="nombramiento" id="nombramiento" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="academia" class="block text-sm font-medium text-gray-700">Academia</label>
                            <input type="text" name="academia" id="academia" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <input type="hidden" name="password" value="123456789">

                        <div class="text-center">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Registrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-admin-layout>
</x-app-layout>
