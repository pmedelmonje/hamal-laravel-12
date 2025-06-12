@extends('layouts.app-layout')

@section('title', $post->title)

@section('content')
    <section class="py-12 bg-night-dark">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Panel lateral izquierdo - Categorías -->
                <div class="lg:w-1/4">
                    <div class="bg-night-grey rounded-lg p-6 border border-star-orange/30 sticky top-8">
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center text-star-orange hover:text-star-orange-light mb-6 transition-colors duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver al blog
                        </a>
                        
                        <!-- Info del artículo actual -->
                        <div class="mb-8">

                            <h4 class="text-sm">Título:</h4>
                            <p class="title-star-white text-md mb-4">{{ $post->title }}</p>

                            <h4 class="text-sm mb-1">Etiquetas:</h4>
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                @foreach($post->categories as $category)
                                <span class="text-xs text-star-orange bg-amber-100/10 px-2 py-1 rounded-full">{{ $category->name }}</span>
                                @endforeach
                            </div>

                            <h4 class="text-sm">Creado en:</h4>
                            <p class="text-xs text-star-white-light/50 mb-4">{{ $post->created_at->format('d M Y') }}</p>
                            
                            <h4 class="text-sm">Visitas:</h4>
                            <h3 class="title-star-white text-xs mb-4">{{ $post->visits_count }}</h3>
                            
                            <!-- Separador -->
                            <div class="w-full h-px bg-gradient-to-r from-transparent via-amber-200 to-transparent my-6"></div>
                            
                            <!-- Compartir -->
                            <div>
                                <h4 class="title-star-orange text-sm uppercase tracking-wider mb-3">Compartir</h4>
                                <div class="flex space-x-3">
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                                        target="_blank"
                                        class="w-8 h-8 rounded-full bg-night-light flex items-center justify-center text-star-white hover:bg-star-orange hover:text-night-dark transition-colors duration-300">
                                        <i class="fab fa-twitter text-sm"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}" 
                                        target="_blank"
                                        class="w-8 h-8 rounded-full bg-night-light flex items-center justify-center text-star-white hover:bg-star-orange hover:text-night-dark transition-colors duration-300">
                                        <i class="fab fa-linkedin-in text-sm"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" 
                                        target="_blank"
                                        class="w-8 h-8 rounded-full bg-night-light flex items-center justify-center text-star-white hover:bg-star-orange hover:text-night-dark transition-colors duration-300">
                                        <i class="fab fa-facebook-f text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <!-- Categorías -->
                        <div class="mb-8">
                            <h3 class="title-star-orange text-xl mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                Categorías
                            </h3>
                            
                            <ul class="space-y-2">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.category', $category->slug) }}" 
                                       class="flex items-center px-3 py-2 rounded-lg {{ $post->categories->contains($category) ? 'bg-star-orange/20 text-star-orange border border-star-orange/30' : 'text-star-white-light hover:bg-night-light' }} transition-colors duration-300">
                                        <span>{{ $category->name }}</span>
                                        <span class="ml-auto bg-night-light px-2 py-1 rounded-full text-xs">
                                            {{ $category->posts_count }}
                                        </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Separador -->
                            <div class="w-full h-px bg-gradient-to-r from-transparent via-amber-200 to-transparent my-6"></div>

                        <!-- Posts relacionados -->
                        @if($relatedPosts->isNotEmpty())
                        <div>
                            <h4 class="title-star-orange text-lg mb-4">Artículos relacionados</h4>
                            <ul class="space-y-3">
                                @foreach($relatedPosts as $related)
                                <li>
                                    <a href="{{ route('blog.show', $related->slug) }}" class="flex items-start space-x-3 group">
                                        <div class="flex-1">
                                            <h5 class="text-sm text-star-white group-hover:text-star-orange transition-colors duration-300">{{ $related->title }}</h5>
                                            <p class="text-xs text-star-white-light/70">{{ $related->created_at->format('d M Y') }}</p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="lg:w-3/4">
                    <article class="bg-night-grey rounded-lg border border-night-light">
                        <div class="p-6 md:p-8">
                            <!-- Encabezado -->
                            <header class="mb-8">
                                <h1 class="title-star-white text-3xl md:text-4xl mb-6">{{ $post->title }}</h1>
                                
                                <div class="flex flex-wrap items-center gap-4 mb-4">
                                    @foreach($post->categories as $category)
                                    <a href="{{ route('blog.category', $category->slug) }}" class="text-xs text-star-orange bg-amber-100/10 px-2 py-1 rounded-full hover:bg-amber-100/20 transition-colors duration-300">
                                        {{ $category->name }}
                                    </a>
                                    @endforeach
                                    <span class="text-xs text-star-white-light/50">{{ $post->created_at->format('d M Y') }}</span>
                                </div>
                            </header>

                            <!-- Contenido del artículo -->
                            <div class="prose prose-invert max-w-none">
                                {!! nl2br(e($post->content)) !!}
                            </div>
                        </div>
                    </article>

                    <!-- Navegación entre posts -->
                    @if($post->getNextPost() || $post->getPreviousPost())
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($post->getPreviousPost())
                        <a href="{{ route('blog.show', $post->getPreviousPost()->slug) }}" class="group flex items-start space-x-4 bg-night-grey rounded-lg p-4 border border-night-light hover:border-star-orange/50 transition-colors duration-300">
                            <svg class="w-6 h-6 text-star-orange mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <div>
                                <span class="text-xs text-star-white-light/50 mb-1">Anterior</span>
                                <h3 class="text-star-white group-hover:text-star-orange transition-colors duration-300">{{ $post->getPreviousPost()->title }}</h3>
                            </div>
                        </a>
                        @endif
                        
                        @if($post->getNextPost())
                        <a href="{{ route('blog.show', $post->getNextPost()->slug) }}" class="group flex items-start space-x-4 bg-night-grey rounded-lg p-4 border border-night-light hover:border-star-orange/50 transition-colors duration-300 text-right md:text-left">
                            <div class="order-2">
                                <span class="text-xs text-star-white-light/50 mb-1">Siguiente</span>
                                <h3 class="text-star-white group-hover:text-star-orange transition-colors duration-300">{{ $post->getNextPost()->title }}</h3>
                            </div>
                            <svg class="w-6 h-6 text-star-orange mt-1 flex-shrink-0 order-1 md:order-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection