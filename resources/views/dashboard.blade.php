<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor flex en columna para diseño responsivo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Primer card: Texto de bienvenida -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-2">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Bienvenido(a) al Panel</h2>
                        <hr class="my-2 border-gray-300 dark:border-gray-600">
                        <p class="text-slate-800">
                            Si puede ver esta página, significa que ha iniciado sesión correctamente.
                        </p>
                        <br>
                        <p class="text-slate-800">
                            <a href="{{ route('home.index') }}"
                                class="font-bold uppercase hover:text-blue-600 dark:hover:text-blue-400">
                                Para ir a la página principal, pulse aquí
                            </a>.
                        </p>
                    </div>
                </div>

                {{-- Tarjeta de datos globales --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-2 md:col-span-2">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 text-center">Recuentos
                        </h2>
                        <div class="w-full p-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div
                                    class="flex flex-col h-32 col-span-3 md:col-span-1 p-4 bg-slate-200 dark:bg-slate-700 rounded-md">
                                    <h2
                                        class="basis-3/4 content-center @if ($answeredContacts->count() < 100000) text-6xl md:text-7xl @else text-4xl md:text-5xl @endif font-bold text-center text-sky-700 dark:text-sky-300">
                                        {{ number_format($answeredContacts->count()) }}
                                    </h2>
                                    <p class="basis-1/4 text-center font-semibold text-md text-slate-800">
                                        {{ $answeredContacts->count() == 1 ? 'Contacto respondido' : 'Contactos respondidos' }}
                                    </p>
                                </div>
                                <div
                                    class="flex flex-col h-32 col-span-3 md:col-span-1 p-4 bg-slate-200 dark:bg-slate-700 rounded-md">
                                    <h2
                                        class="basis-3/4 content-center @if ($unansweredContacts->count() < 100000) text-6xl md:text-7xl @else text-4xl md:text-5xl @endif font-bold text-center text-green-700 dark:text-green-300">
                                        {{ number_format($unansweredContacts->count()) }}
                                    </h2>
                                    <p class="basis-1/4 text-center font-semibold text-md text-slate-800">
                                        {{ $unansweredContacts->count() == 1 ? 'Contacto sin responder' : 'Contactos sin responder' }}
                                    </p>
                                </div>
                                <div
                                    class="flex flex-col h-32 col-span-3 md:col-span-1 p-4 bg-slate-200 dark:bg-slate-700 rounded-md">
                                    <h2
                                        class="basis-3/4 content-center @if ($totalBlogVisits < 100000) text-6xl md:text-7xl @else text-4xl md:text-5xl @endif font-bold text-center text-amber-700 dark:text-amber-300">
                                        {{ number_format($totalBlogVisits) }}
                                    </h2>
                                    <p class="basis-1/4 text-center font-semibold text-md text-slate-800">
                                        {{ $totalBlogVisits == 1 ? 'Visita a los Posts' : 'Visitas a los Posts' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de contactos recientes -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-2 md:col-span-1">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 text-center">Contactos
                            recientes</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-night-grey">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 w-2/6 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-2/6 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-1/6 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Respondido
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-1/6 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Creado en
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white dark:bg-night-light divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($recentContacts as $contact)
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
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-star-cyan text-night-dark-blue">
                                                    {{ $contact->is_answered ? 'Sí' : 'No' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-star-cyan text-night-dark-blue">
                                                    {{ $contact->created_at }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                No se encontraron contactos
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Posts más visitados -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-2 md:col-span-1">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 text-center">Post más
                            visitados</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-night-grey">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 w-2/6 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Título
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-2/6 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Creación
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-1/6 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Visitas
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white dark:bg-night-light divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($mostVisitedPosts as $post)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $post->title }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $post->created_at }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-star-cyan text-night-dark-blue">
                                                    {{ $post->visits_count }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                No se encontraron posts
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
