<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Grupos de Habilidades
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Listado de tipos de proyecto -->
                    <div class="mb-8">
                        
                        @if ($errors->any())
                            <x-alert type="danger">
                                <x-slot name="title">
                                    Hay errores en el formulario.
                                </x-slot>
                                Corrija los errores y vuelva a intentar
                            </x-alert>
                        @endif

                        <h3 class="text-lg font-medium mb-4">Información de grupo de habilidades</h3>
                        <!-- Formulario para actualizar tipo -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium mb-4">Actualizar información</h3>

                            <form method="POST" action="{{ route('skill-groups-dashboard.update', $skillGroup->id) }}" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="col col-span-4 md:col-span-3">
                                        <label for="name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                        <input type="text" name="name" id="name" required
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm"
                                            value="{{ $skillGroup->name }}">
                                        @error('name')
                                            <p class="text-red-900">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col col-span-4 md:col-span-1">
                                        <label for="index"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Índice</label>
                                        <input type="number" name="index" id="index" required
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm"
                                            value="{{ $skillGroup->index }}">
                                    </div>
                                    <div class="flex justify-start">
                                        <button type="submit"
                                            onclick="return confirm('¿Actualizar la información?')"
                                            class="inline-flex items-center px-4 py-2 bg-star-cyan border border-transparent rounded-md text-night-dark-blue hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Guardar cambios
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
