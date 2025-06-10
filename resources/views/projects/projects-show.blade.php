@extends('layouts.app-layout')

@section('title', $project->name)

@section('content')
    <section class="py-12 bg-night-dark">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-night-grey rounded-lg p-6 border border-star-cyan/30 sticky top-8">
                        <h4 class="title-star-white text-xl mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-star-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Información general
                        </h4>

                        <!-- Imagen del proyecto -->
                        @if(isset($project->filepath))
                        <div class="mb-8 overflow-hidden rounded-lg border border-star-cyan/30">
                            <img src="{{ asset($project->filepath) }}" 
                                 alt="{{ $project->name }}" 
                                 class="h-40 w-full object-cover">
                        </div>
                        @endif

                        <!-- Nombre -->
                        <div class="mb-6">
                            <h5 class="text-star-cyan text-sm font-semibold uppercase tracking-wider mb-2">Nombre</h5>
                            <div class="bg-night-light rounded-lg p-3">
                                <span class="inline-block title-star-cyan font-medium text-sm">
                                    {{ $project->name }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Tipo de proyecto -->
                        <div class="mb-6">
                            <h5 class="text-star-cyan text-sm font-semibold uppercase tracking-wider mb-2">Tipo de proyecto</h5>
                            <div class="bg-night-light rounded-lg p-3">
                                <span class="inline-block text-white text-md font-medium text-sm">
                                    {{ $project->projectType->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Tecnologías -->
                        <div class="mb-6">
                            <h5 class="text-star-cyan text-sm font-semibold uppercase tracking-wider mb-2">Tecnologías</h5>
                            <div class="bg-night-light rounded-lg p-3">
                                @if(is_string($project->technologies))
                                    <p class="text-star-white-light text-sm">{{ $project->technologies }}</p>
                                @elseif($project->technologies && $project->technologies->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($project->technologies as $tech)
                                        <span class="px-2 py-1 bg-night-grey text-star-white rounded text-sm border border-star-white/30">
                                            {{ $tech->name }}
                                        </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-star-white-light/50 italic">No especificadas</p>
                                @endif
                            </div>
                        </div>

                        <!-- URL -->
                        <div class="mb-6">
                            <h5 class="text-star-cyan text-sm font-semibold uppercase tracking-wider mb-2">URL del proyecto</h5>
                            <div class="bg-night-light rounded-lg p-3">
                                @if ($project->url)
                                    <a href="{{ $project->url }}" 
                                       class="text-star-white hover:text-star-cyan inline-flex items-center group" 
                                       target="_blank" 
                                       rel="noopener noreferrer">
                                        <span class="break-all text-sm">{{ $project->url }}</span>
                                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                @else
                                    <p class="text-star-white-light/50 italic">No indicada</p>
                                @endif
                            </div>
                        </div>

                        <!-- Estado del proyecto -->
                        @if(isset($project->status))
                        <div class="mb-6">
                            <h5 class="text-star-cyan text-sm font-semibold uppercase tracking-wider mb-2">Estado</h5>
                            <div class="bg-night-light rounded-lg p-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm
                                    {{ $project->status === 'completed' ? 'bg-star-green/20 text-star-green' : 
                                       ($project->status === 'in_progress' ? 'bg-star-orange/20 text-star-orange' : 
                                        'bg-star-blue/20 text-star-blue') }}">
                                    <span class="w-2 h-2 rounded-full mr-2 
                                        {{ $project->status === 'completed' ? 'bg-star-green' : 
                                           ($project->status === 'in_progress' ? 'bg-star-orange' : 'bg-star-blue') }}"></span>
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="lg:col-span-2">
                    <div class="bg-night-grey rounded-lg p-6 md:p-8 border border-star-cyan/30">

                        <!-- Título y descripción -->
                        <div class="mb-8">
                            <h1 class="text-3xl md:text-4xl title-star-cyan mb-6">Descripción</h1>
                            
                            <div class="prose prose-invert max-w-none">
                                <div class="text-star-white-light leading-relaxed text-sm space-y-4">
                                    {!! nl2br(e($project->description)) !!}
                                </div>
                            </div>
                        </div>

                        <!-- Características destacadas -->
                        @if(isset($project->features) && is_array($project->features))
                        <div class="mb-8">
                            <h4 class="text-2xl title-star-cyan mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-star-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Características destacadas
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($project->features as $feature)
                                <div class="flex items-start space-x-3 bg-night-light rounded-lg p-4 hover:bg-night-light/80 transition-colors duration-300">
                                    <svg class="w-5 h-5 text-star-cyan mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-star-white-light">{{ $feature }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Separador -->
                        <div class="w-full h-px bg-gradient-to-r from-transparent via-star-cyan to-transparent my-8"></div>

                        <!-- Call to action -->
                        <div class="bg-night-light rounded-lg p-6 border border-star-cyan/30">
                            <div class="text-center">
                                <h5 class="text-xl title-star-white mb-3">¿Le interesa este proyecto?</h5>
                                <p class="text-star-white-light mb-6 max-w-2xl mx-auto">
                                    ¿Quiere saber más acerca de este u otros proyectos? Me encantaría conversar con usted.
                                </p>
                                <a href="{{ route('contact.index') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-star-cyan text-night-light rounded-lg font-bold transition-all duration-300 hover:bg-star-cyan-light hover:shadow-glow-cyan group">
                                    Conversemos
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Navegación -->
                    <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <a href="{{ route('projects.index') }}" 
                           class="inline-flex items-center text-star-white hover:text-star-cyan transition-colors duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver a proyectos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection