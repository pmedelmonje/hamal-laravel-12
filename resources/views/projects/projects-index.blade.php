@extends('layouts.app-layout')

@section('title', 'Proyectos')

@section('content')
    <section class="py-12 bg-night-dark">
        <div class="container mx-auto px-4">
            <!-- Filtros -->
            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-4 mb-6">
                    <a href="{{ route('projects.index') }}" 
                       class="px-4 py-2 link-star-cyan transition-colors duration-300 {{ request()->routeIs('projects.index') ? 'title-star-cyan' : 'link-star-white' }}">
                        Todos
                    </a>
                    
                    @foreach ($project_types as $project_type)
                        <a href="{{ route('projects.filtered_projects', $project_type->slug) }}" 
                           class="px-4 py-2 link-star-cyan transition-colors duration-300 {{ request()->route('slug') == $project_type->slug ? 'title-star-cyan' : 'link-star-white' }}">
                            {{ $project_type->name }}
                        </a>
                    @endforeach
                </div>
                
                @if(count($project_types) > 4)
                <div class="md:hidden">
                    <select onchange="window.location.href=this.value" class="w-full bg-night-light text-star-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-star-cyan">
                        <option value="{{ route('projects.index') }}" {{ request()->routeIs('projects.index') ? 'selected' : '' }}>
                            Todos los proyectos
                        </option>
                        @foreach ($project_types as $project_type)
                            <option value="{{ route('projects.filtered_projects', $project_type->slug) }}" 
                                    {{ request()->route('slug') == $project_type->slug ? 'selected' : '' }}>
                                {{ $project_type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <!-- Grid de proyectos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                <div class="group">
                    <a href="{{ route('projects.projects-show', $project->slug) }}" class="block h-full">
                        <div class="bg-night-grey rounded-lg overflow-hidden border border-night-light group-hover:border-star-cyan transition-colors duration-300 h-full flex flex-col">
                            <!-- Imagen del proyecto -->
                            <div class="h-48 bg-gradient-to-br from-star-cyan/20 to-star-orange/20 relative overflow-hidden">
                                @if ($project->filepath)
                                    <img 
                                        src="{{ asset($project->filepath) }}" 
                                        alt="{{ $project->name }}"
                                        class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105"
                                    >
                                    <div class="absolute inset-0 bg-slate-700/30 group-hover:bg-slate-400/10 transition-all duration-300"></div>
                                @else
                                    <!-- Placeholder si no hay imagen -->
                                    <img src="{{ asset('img/programacion_filtrado.png') }}" 
                                    alt="Imagen"
                                    class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
                                    <div class="absolute inset-0 bg-slate-700/30 group-hover:bg-slate-400/10 transition-all duration-300"></div>
                                    {{-- <div class="absolute inset-0 bg-slate-700/30 group-hover:bg-slate-400/10 transition-all duration-300"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-star-cyan/50 group-hover:text-star-cyan/80 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div> --}}
                                @endif
                                
                                @if($project->project_type)
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-1 text-xs rounded-full bg-star-orange text-night-dark font-mono">
                                        {{ $project->project_type->name }}
                                    </span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Contenido -->
                            <div class="p-6 flex-1 flex flex-col">
                                <h4 class="text-star-cyan text-center text-xl font-semibold mb-3 group-hover:text-star-cyan-light transition-colors duration-300">
                                    {{ $project->name }}
                                </h4>
                                
                                <div class="w-full h-px bg-gradient-to-r from-transparent via-star-cyan to-transparent mb-4"></div>
                                
                                <p class="text-star-white-light text-center flex-1 mb-4 leading-relaxed">
                                    {{ $project->short_description }}
                                </p>

                                <p class="text-star-white-light text-center flex-1 mb-4 leading-relaxed text-xs">
                                    Tecnologías: {{ $project->technologies }}
                                </p>
                                
                                <div class="text-center mt-auto">
                                    <span class="inline-flex items-center text-star-cyan group-hover:text-star-cyan-light transition-colors duration-300">
                                        Pulse para ver más
                                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            
            @if($projects->isEmpty())
            <div class="text-center py-12">
                <div class="max-w-md mx-auto">
                    <svg class="w-16 h-16 text-star-cyan/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="title-star-white text-xl mb-2">No hay proyectos disponibles</h3>
                    <p class="text-star-white-light/70">Pronto habrá nuevos proyectos para mostrar.</p>
                </div>
            </div>
            @endif
            
            <div class="mt-12">
                {{ $projects->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </section>
@endsection