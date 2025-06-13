<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Mensaje de {{ $contact->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-night-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulario de actualización -->
                    <form method="POST" action="{{ route('contacts-dashboard.update', $contact->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 gap-6 mb-8">
                            <!-- Nombre (no editable) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Nombre
                                </label>
                                <div class="mt-1 p-2 bg-gray-100 dark:bg-night-grey rounded-md">
                                    <p class="text-gray-900 dark:text-gray-100">{{ $contact->name }}</p>
                                </div>
                            </div>

                            <!-- Email (no editable) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Email
                                </label>
                                <div class="mt-1 p-2 bg-gray-100 dark:bg-night-grey rounded-md">
                                    <p class="text-gray-900 dark:text-gray-100">{{ $contact->email }}</p>
                                </div>
                            </div>

                            <!-- Mensaje (no editable) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Mensaje
                                </label>
                                <div class="mt-1 p-2 bg-gray-100 dark:bg-night-grey rounded-md whitespace-pre-line">
                                    <p class="text-gray-900 dark:text-gray-100">{{ $contact->message }}</p>
                                </div>
                            </div>

                            <!-- Switch para estado de respuesta -->
                            <div class="col-span-1 md:col-span-1">
                                <label class="inline-flex items-center mb-2 cursor-pointer">
                                    <input type="checkbox" value="" name="is_answered" class="sr-only peer"
                                    {{ $contact->is_answered ? 'checked' : '' }}>
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-slate-800 rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-slate-600 dark:peer-checked:bg-slate-600">
                                    </div>
                                    <span class="ms-3 text-sm font-medium text-slate-800 dark:text-slate-200">Respondido</span>
                                </label>
                            </div> 
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('contacts-dashboard.index') }}" 
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-night-grey focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-star-cyan">
                                Volver
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-star-cyan border border-transparent rounded-md font-semibold text-night-dark-blue hover:bg-star-orange focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                Actualizar estado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>