<x-app-layout>
    <x-admin-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-bold mb-4">Subir Constancia de Terminación</h2>
                        
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('informes.uploadConstancia', $solicitud->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="constancia_pdf">Subir PDF de Constancia:</label>
                                <input type="file" name="constancia_pdf" id="constancia_pdf" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('constancia_pdf')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex items-center justify-center">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Subir
                                </button>
                                <a href="{{ route('adminDashboard') }}" class="px-4 btn btn-secondary float-left">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
</x-app-layout>
