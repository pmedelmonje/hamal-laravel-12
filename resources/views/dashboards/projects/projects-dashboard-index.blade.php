<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Proyectos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if (@session('success'))
                        <x-alert type="success">
                            <x-slot name="title">
                                Información.
                            </x-slot>
                            {{ session('success') }}
                        </x-alert>
                    @endif

                    @if (@session('info'))
                        <x-alert type="info">
                            <x-slot name="title">
                                Información.
                            </x-slot>
                            {{ session('info') }}
                        </x-alert>
                    @endif

                    <!-- Filtros y botón de crear -->
                    <div class="flex justify-between items-center mb-6">
                        <form method="GET" action="{{ route('projects-dashboard.index') }}"
                            class="flex items-center gap-4">
                            <select name="type" onchange="this.form.submit()"
                                class="border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                <option value="">Todos los tipos</option>
                                @foreach ($projectTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $selectedType == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <a href="{{ route('projects-dashboard.create') }}"
                            class="inline-flex items-center px-4 py-1 bg-star-cyan border border-transparent rounded-md text-night-dark-blue hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                            Nuevo
                        </a>
                    </div>

                    <!-- Tabla de proyectos -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-night-grey">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 w-2/5 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 w-1/5 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Slug
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 w-1/5 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 w-1/5 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-night-light divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($projects as $project)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $project->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ Str::limit($project->short_description, 50) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $project->slug }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-star-cyan text-night-dark-blue">
                                                {{ $project->projectType->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('projects-dashboard.show', $project->slug) }}"
                                                class="text-sky-600 hover:text-sky-400 mr-3">Editar</a>
                                            <form action="#" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-700 hover:text-red-300"
                                                    onclick="return confirm('¿Realmente quieres eliminar este proyecto?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No se encontraron proyectos
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
