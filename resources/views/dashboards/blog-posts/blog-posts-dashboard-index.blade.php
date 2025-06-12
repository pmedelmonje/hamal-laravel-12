<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Posts del Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Alertas -->
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
                        <form method="GET" action="{{ route('blog-posts-dashboard.index') }}" class="flex items-center gap-4">
                            <select name="category" onchange="this.form.submit()"
                                class="border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                <option value="">Todas las categorías</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" {{ $selectedCategory == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <a href="{{ route('blog-posts-dashboard.create') }}"
                            class="inline-flex items-center px-4 py-1 bg-star-cyan border border-transparent rounded-md text-night-dark-blue hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                            Nuevo Post
                        </a>
                    </div>

                    <!-- Tabla de posts -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-night-grey">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-3/5 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Título
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-1/5 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-1/5 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-night-light divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $post->title }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                @foreach ($post->categories as $category)
                                                    <span class="px-1.5 py-0.5 text-xs rounded-full bg-gray-200 dark:bg-gray-700">{{ $category->name }}</span>
                                                    @if (!$loop->last) @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $post->published ? 'Publicado' : 'Borrador' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('blog-posts-dashboard.show', $post->slug) }}"
                                                class="text-sky-600 hover:text-sky-400 mr-3">Editar</a>
                                            <form action="{{ route('blog-posts-dashboard.destroy', $post->slug) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-700 hover:text-red-300"
                                                    onclick="return confirm('¿Eliminar este post?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No se encontraron posts
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>