@extends('layouts.app-layout')

@section('title', 'Contacto')

@section('content')
    <section class="py-12 bg-night-dark">
        <div class="container mx-auto px-4">
            <!-- Alertas -->
            @if (session('status'))
                <div class="flex justify-center mb-8">
                    <div class="w-full max-w-2xl">
                        <div class="bg-star-cyan/20 text-star-cyan border border-star-cyan/30 rounded-lg px-4 py-3 relative"
                            role="alert">
                            <p>{{ session('status') }}</p>
                            <button type="button" class="absolute top-3 right-3 text-star-cyan hover:text-star-cyan-light"
                                aria-label="Close">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="flex justify-center mb-8">
                    <div class="w-full max-w-2xl">
                        <div class="bg-star-orange/20 text-star-orange border border-star-orange/30 rounded-lg px-4 py-3 relative"
                            role="alert">
                            <p class="font-bold">Hay errores en el formulario.</p>
                            <p>Revise los errores y vuelva a intentar.</p>
                            <button type="button"
                                class="absolute top-3 right-3 text-star-orange hover:text-star-orange-light"
                                aria-label="Close">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-8">
                <!-- Información de contacto -->
                <div class="md:w-1/3 px-4">
                    <h4 class="title-star-white text-2xl mb-4">Contacto</h4>
                    <div class="flex items-center justify-center py-2">
                        <div class="w-full border-t border-star-cyan/30"></div>
                    </div>

                    <div class="space-y-4 text-star-white-light">
                        <p>
                            A su disposición, tiene el siguiente formulario para contactarme, por ejemplo,
                            si tiene alguna consulta sobre mis servicios. Mientras mis gatos no aprendan a escribir,
                            responderé yo mismo.
                        </p>
                        <p>
                            ¿Le interesa su bienestar general? Escríbame también.
                        </p>
                        <p>
                            ¿Quiere saber quiénes me hacen los dibujos? Escríbame también.
                        </p>
                    </div>

                    <!-- Información adicional (opcional) -->
                    <div class="mt-8 pt-6 border-t border-star-cyan/30">
                        <h5 class="title-star-orange text-lg mb-4">Mi Currículum</h5>
                        <ul class="space-y-3 text-star-white-light">
                            {{-- <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-star-cyan mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>pedro@example.com</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-star-cyan mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span>+56 9 1234 5678</span>
                            </li> --}}
                            <li class="flex items-start space-x-3">
                                <span><a href="{{ asset('uploads/cv_pmedel.pdf') }}" target="_blank"><i class="fa-regular fa-file-pdf text-star-cyan mr-2"></i>Descargar PDF</a></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Formulario -->
                <div class="md:w-2/3 px-4">
                    <h4 class="title-star-white text-2xl mb-4">Formulario de contacto</h4>
                    <div class="flex items-center justify-center py-2">
                        <div class="w-full border-t border-star-cyan/30"></div>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" id="contactForm">
                        @csrf

                        <!-- Campo Nombre -->
                        <div>
                            <label for="name" class="block text-star-white-light mb-2">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full bg-night-light border border-night-light rounded-lg px-4 py-3 text-star-white-light focus:outline-none focus:ring-2 focus:ring-star-cyan focus:border-transparent placeholder-star-white-light/50"
                                placeholder="Su nombre aquí">
                            @error('name')
                                <p class="mt-1 text-star-orange text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Email -->
                        <div>
                            <label for="email" class="block text-star-white-light mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full bg-night-light border border-night-light rounded-lg px-4 py-3 text-star-white-light focus:outline-none focus:ring-2 focus:ring-star-cyan focus:border-transparent placeholder-star-white-light/50"
                                placeholder="name@example.com">
                            @error('email')
                                <p class="mt-1 text-star-orange text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Mensaje -->
                        <div>
                            <label for="message" class="block text-star-white-light mb-2">Mensaje</label>
                            <textarea id="message" name="message" rows="6"
                                class="w-full bg-night-light border border-night-light rounded-lg px-4 py-3 text-star-white-light focus:outline-none focus:ring-2 focus:ring-star-cyan focus:border-transparent placeholder-star-white-light/50"
                                placeholder="Escriba su mensaje aquí...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-star-orange text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón de envío -->
                        <div>
                            <button type="button" onclick="confirmForm('¿Enviar el formulario de contacro?')"
                                class="px-6 py-3 bg-star-cyan text-night-light rounded-lg font-medium hover:bg-star-cyan-light hover:shadow-glow-cyan transition-all duration-300">
                                Enviar mensaje
                                <svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function confirmForm(text) {
            Swal.fire({
                title: 'Confirmación',
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1e293b',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
                background: 'rgba(64, 72, 84, 1)',
                backdrop: 'rgba(36,46,59,0.7)',
                customClass: {
                    popup: 'border border-sky-600 rounded-lg shadow-xl',
                    title: 'text-white',
                    htmlContainer: 'text-white',
                    confirmButton: 'text-white bg-night-dark hover:bg-night-darker',
                    cancelButton: 'text-white bg-red-600 hover:bg-red-700',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('confirmForm').submit();
                }
            });
        }
    </script>

@endsection
