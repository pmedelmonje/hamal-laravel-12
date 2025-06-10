<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tipos de Proyecto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Listado de tipos de proyecto -->
                    <div class="mb-8">

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

                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium mb-4">Listado de Tipos</h3>
                            <a href="{{ route('project-types-dashboard.create') }}"
                                class="inline-flex items-center px-4 py-1 bg-star-cyan border border-transparent rounded-md text-night-dark-blue hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                Nuevo
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-night-grey">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 w-3/5 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-1/5 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Orden
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-1/5 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white dark:bg-night-light divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($projectTypes as $type)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $type->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-star-cyan text-night-dark-blue">
                                                    {{ $type->index }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('project-types-dashboard.show', $type->slug) }}"
                                                    class="text-sky-600 hover:text-sky-400 mr-3">Editar</a>
                                                <form
                                                    action="{{ route('project-types-dashboard.destroy', $type->slug) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-700 hover:text-red-300"
                                                        onclick="return confirm('¿Estás seguro de eliminar este tipo? Se eliminarán todos los proyectos asociados.')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                No se encontraron tipos de proyecto
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $projectTypes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
