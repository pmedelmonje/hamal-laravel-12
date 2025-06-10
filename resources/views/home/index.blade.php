@extends('layouts.app-layout')

@section('title', 'Inicio')

@section('content')
    <!-- Sobre Mí -->
    <section id="sobre-mi" class="py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-center title-star-white text-3xl font-bold mb-6">Sobre Mí</h2>
            <div class="flex items-center justify-center">
                <div class="max-w-3xl">
                    <p class="text-center mb-4">
                        Bienvenido(a) a mi portafolio. Mi nombre es Pedro, y soy programador autodidacta localizado en 
                        Chile. He realizado algunos proyectos como freelancer y ya he tenido la oportunidad de trabajar para
                        una agencia.
                    </p>
                    <p class="text-center mb-4">
                        Estoy en permanente aprendizaje, orientado al backend, las interfaces gráficas y el
                        manejo de Bases de Datos relacionales.
                        Mi primer lenguaje, por ahí por 2002, fue dBase III Plus. Mucho tiempo después, aprendí Arduino;
                        luego Python, pasando por varios frameworks; y ahora últimamente, PHP
                        con Laravel. También he tocado otros lenguajes, como JavaScript, Dart y Micropython.
                    </p>
                    <p class="text-center mb-4">
                        Como datos personales, me gusta ver las estrellas en la noche (creo que se nota);
                        tengo varios gatos;
                      	me gusta tanto el choclo que, de ser por mí, basaría mi dieta completa en el maíz, 
                      	y también las arvejas.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Mis Servicios -->
    <section id="mis-servicios" class="py-12 bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-center title-star-white text-3xl font-bold mb-6">Mis Servicios</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-8 max-w-5xl mx-auto">
                <div class="bg-gray-700 p-6 rounded-lg border border-gray-600 hover:border-white transition-colors duration-300">
                    <h3 class="text-white text-center text-xl font-semibold mb-4">Sitios y apps web, y programas varios</h3>
                    <p class="text-gray-300 text-center mb-4">
                        Sitios web de distintos tipos, por ejemplo, para ofrecer productos, servicios, etc. 
                        Mis sitios incluyen un Panel de Control que permitirá gestionar eficientemente todos los 
                        elementos.
                    </p>
                    <p class="text-gray-300 text-center">
                        Igualmente ofrezco programas de escritorio de distintos tipos, compatibles tanto con Windows
                        como con Linux.
                    </p>
                </div>
                <div class="bg-gray-700 p-6 rounded-lg border border-gray-600 hover:border-white transition-colors duration-300">
                    <h3 class="text-white text-center text-xl font-semibold mb-4">Tutoriales y orientación</h3>
                    <p class="text-gray-300 text-center mb-4">
                        Tutoriales introductorios acerca de la lógica de programación; ejercicios básicos;
                        informática básica; uso de herramientas como Git; lenguajes como HTML, CSS, Python, Markdown, etc.
                    </p>
                    <p class="text-gray-300 text-center">
                        También ofrezco orientación a personas que sienten inquietud por estudiar una carrera tecnológica.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Habilidades -->
    <section id="habilidades" class="py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-center">
                <div class="max-w-3xl">
                    <h2 class="text-center title-star-white text-3xl font-bold mb-6">Habilidades</h2>
                    @foreach ($skill_groups as $skill_group)
                        <div class="mb-6">
                            <h4 class="text-center title-star-orange text-xl font-semibold mb-3">{{ $skill_group->name }}</h4>
                            <div class="text-gray-300 text-center">
                                <p>
                                    @foreach ($skill_group->skills as $skill)
                                    <span>{{ $skill->name }} ({{ $skill->skill_level }})</span>
                                    @if (!$loop->last)
                                        <span class="text-gray-500 mx-2">•</span>
                                    @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- Proyectos -->
    <section id="algunos-proyectos" class="py-12 bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-center title-star-cyan text-3xl font-bold mb-6">Proyectos recientes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-8 max-w-6xl mx-auto">
                @foreach ($recent_projects as $project)
                <a href="{{ route('projects.projects-show', $project->slug) }}" class="group">
                    <div class="bg-gray-700 p-6 rounded-lg border border-gray-600 hover:border-star-cyan transition-colors duration-300 h-full">
                        <h4 class="text-star-cyan text-center text-lg font-semibold mb-3 group-hover:text-sky-200">{{ $project->name }}</h4>
                        <div class="w-full h-px bg-gradient-to-r from-transparent via-sky-200 to-transparent mb-4"></div>
                        <p class="text-gray-300 text-center">
                            {{ $project->short_description }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('projects.index') }}" class="link-star-cyan hover:text-sky-200 font-medium">Ver todos los proyectos →</a>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-center title-star-white text-3xl font-bold mb-6">¿Quiere saber más?</h2>
            <div class="flex items-center justify-center">
                <div class="max-w-3xl">
                    <p class="text-center text-gray-300 mb-6">
                        Si quiere saber más de <span class="text-star-orange font-medium">mis servicios</span>, o si quiere descargar mi CV, escríbame.
                    </p>
                    <div class="text-center">
                        <a href="{{ route('contact.index') }}" class="inline-block bg-star-orange hover:bg-orange-500 text-gray-900 font-bold py-3 px-6 rounded-lg transition-colors duration-300">
                            Sí, quiero saber más
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection