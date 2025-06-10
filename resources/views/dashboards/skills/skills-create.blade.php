<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nueva Habilidad
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if ($errors->any())
                        <x-alert type="danger">
                            <x-slot name="title">
                                Hay errores en el formulario.
                            </x-slot>
                            Corrija los errores y vuelva a intentar
                        </x-alert>
                    @endif

                    <form method="POST" action="{{ route('skills-dashboard.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Tipo de Proyecto -->
                            <div>
                                <label for="skill_group_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Grupo de habilidades <span class="text-star-red">*</span>
                                </label>
                                <select id="skill_group_id" name="skill_group_id" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                    <option value="">Seleccione un tipo</option>
                                    @foreach ($skillGroups as $group)
                                        <option value="{{ $group->id }}"
                                            {{ old('skill_group_id') == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('skill_group_id')
                                    <p class="mt-1 text-sm text-star-red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-4 gap-4">
                                <!-- Nombre del Proyecto -->
                                <div class="col col-span-4 md:col-span-3">
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Nombre <span class="text-star-red">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                    @error('name')
                                        <p class="mt-1 text-sm text-star-red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Índice -->
                                <div class="col col-span-4 md:col-span-1">
                                    <label for="index"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Índice <span class="text-star-red">*</span>
                                    </label>
                                    <input type="number" id="index" name="index" value="{{ old('index', 1) }}" required
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                    @error('index')
                                        <p class="mt-1 text-sm text-star-red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nivel -->
                            <div>
                                <label for="skill_level"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Nivel <span class="text-star-red">*</span>
                                </label>
                                <input type="text" id="skill_level" name="skill_level"
                                    value="{{ old('skill_level') }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm"
                                    placeholder="Ej: Principiante, Intermedio, B1, etc.">
                                @error('skill_level')
                                    <p class="mt-1 text-sm text-star-red">{{ $message }}</p>
                                @enderror
                            </div>

                        <div class="flex justify-end mt-6 gap-4">
                            <a href="{{ route('skills-dashboard.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-night-grey focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-star-cyan">
                                Cancelar
                            </a>
                            <button type="submit" onclick="return confirm('¿Crear registro?')"
                                class="inline-flex items-center px-4 py-2 bg-star-cyan border border-transparent rounded-md font-semibold text-night-dark-blue hover:bg-star-orange focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                Guardar Proyecto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
