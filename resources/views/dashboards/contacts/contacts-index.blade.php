<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Contactos
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

                    <!-- Filtros -->
                    <div class="flex justify-between items-center mb-6">
                        <form method="GET" action="{{ route('contacts-dashboard.index') }}"
                            class="flex items-center gap-4">
                            <select name="is_answered" onchange="this.form.submit()"
                                class="border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                <option value="">Todos los estados</option>
                                <option value="1" {{ request('is_answered') === '1' ? 'selected' : '' }}>
                                    Respondidos</option>
                                <option value="0" {{ request('is_answered') === '0' ? 'selected' : '' }}>No
                                    respondidos</option>
                            </select>
                        </form>
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
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 w-1/5 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Respondido
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 w-1/5 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-night-light divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($contacts as $contact)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $contact->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $contact->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-star-cyan text-night-dark-blue">
                                                {{ $contact->is_answered ? 'Sí' : 'No' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('contacts-dashboard.show', $contact->id) }}"
                                                class="text-sky-600 hover:text-sky-400 mr-3">Ver</a>
                                            <form action="{{ route('contacts-dashboard.destroy', $contact->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-700 hover:text-red-300"
                                                    onclick="return confirm('¿Realmente quieres eliminar este contacto?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No se encontraron registros
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
