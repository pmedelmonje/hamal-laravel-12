<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crear Nuevo Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('blog-posts-dashboard.store') }}">
                        @csrf

                        @if ($errors->any())
                            <x-alert type="danger">
                                <x-slot name="title">
                                    Hay errores en el formulario.
                                </x-slot>
                                Corrija los errores y vuelva a intentar
                            </x-alert>
                        @endif

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Título -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Título <span class="text-star-red">*</span>
                                </label>
                                <input type="text" id="title" name="title" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm">
                                @error('title')
                                    <p class="text-red-900">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Categorías -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Categorías <span class="text-star-red">*</span>
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2">
                                    @foreach($categories as $category)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                class="rounded border-gray-300 text-star-cyan focus:ring-star-cyan">
                                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Contenido -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Contenido <span class="text-star-red">*</span>
                                </label>
                                <textarea id="content" name="content" rows="15" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-night-grey dark:text-gray-300 focus:border-star-cyan focus:ring-star-cyan rounded-md shadow-sm"></textarea>
                                    @error('content')
                                        <p class="text-red-900">{{ $message }}</p>
                                    @enderror
                            </div>

                            <!-- Publicado -->
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="published"
                                        class="rounded border-gray-300 text-star-cyan focus:ring-star-cyan">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Publicar inmediatamente</span>
                                </label>
                                @error('published')
                                    <p class="text-red-900">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6 gap-4">
                            <a href="{{ route('blog-posts-dashboard.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-night-grey focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-star-cyan">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-star-cyan border border-transparent rounded-md font-semibold text-night-dark-blue hover:bg-star-orange focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                Guardar Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>