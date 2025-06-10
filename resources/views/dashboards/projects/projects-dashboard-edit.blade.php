<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Proyecto: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('projects-dashboard.update', $project->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Tipo de Proyecto -->
                            <div>
                                <label for="project_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Tipo de Proyecto <span class="text-star-red">*</span>
                                </label>
                                <select id="project_type_id" name="project_type_id" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                    @foreach($projectTypes as $type)
                                        <option value="{{ $type->id }}" {{ $project->project_type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nombre del Proyecto -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Nombre del Proyecto <span class="text-star-red">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                            </div>

                            <!-- Tecnologías -->
                            <div>
                                <label for="technologies" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Tecnologías utilizadas <span class="text-star-red">*</span>
                                </label>
                                <input type="text" id="technologies" name="technologies" value="{{ old('technologies', $project->technologies) }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                            </div>

                            <!-- URL -->
                            <div>
                                <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    URL del Proyecto
                                </label>
                                <input type="url" id="url" name="url" value="{{ old('url', $project->url) }}"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                            </div>

                            <!-- Descripción Corta -->
                            <div>
                                <label for="short_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Descripción corta <span class="text-star-red">*</span>
                                </label>
                                <textarea id="short_description" name="short_description" required rows="3"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">{{ old('short_description', $project->short_description) }}</textarea>
                            </div>

                            <!-- Descripción Completa -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Descripción completa <span class="text-star-red">*</span>
                                </label>
                                <textarea id="description" name="description" required rows="5"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">{{ old('description', $project->description) }}</textarea>
                            </div>

                            <!-- Imagen actual -->
                            @if($project->filename)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Imagen actual
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <a href="{{ asset($project->filepath) }}" target="_blank" class="text-sky-600 hover:text-sky-400">
                                            Ver imagen actual
                                        </a>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="remove_image" class="rounded border-gray-300 text-star-cyan focus:ring-star-cyan">
                                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Eliminar imagen</span>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <!-- Nueva imagen -->
                            <div>
                                <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ $project->filename ? 'Cambiar imagen' : 'Imagen del proyecto (opcional)' }}
                                </label>
                                <input type="file" id="file" name="file" accept="image/png, image/jpeg"
                                    class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-star-cyan file:text-night-dark-blue
                                    hover:file:bg-star-orange">
                            </div>
                        </div>

                        <div class="flex justify-end mt-6 gap-4">
                            <a href="{{ route('projects-dashboard.show', $project->slug) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-night-grey focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-star-cyan">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-star-cyan border border-transparent rounded-md font-semibold text-night-dark-blue hover:bg-star-orange focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                Actualizar Proyecto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>