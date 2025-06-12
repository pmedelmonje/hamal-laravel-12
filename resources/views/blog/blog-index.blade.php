@extends('layouts.app-layout')

@section('title', 'Blog')

@section('content')
    <section class="py-12 bg-night-dark">
        <div class="container mx-auto px-2">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Panel lateral izquierdo - Categorías -->
                <div class="lg:w-1/4">
                    <div class="bg-night-grey rounded-lg p-6 border border-star-orange/30 sticky top-8">
                        <h3 class="title-star-orange text-xl mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Categorías
                        </h3>

                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('blog.index') }}"
                                    class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('blog.index') ? 'bg-star-orange/20 text-star-orange border border-star-orange/30' : 'text-star-white-light hover:bg-night-light' }} transition-colors duration-300">
                                    <span>Todas las entradas</span>
                                    <span class="ml-auto bg-night-light px-2 py-1 rounded-full text-xs">
                                        {{ $posts->total() }}
                                    </span>
                                </a>
                            </li>

                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('blog.category', $category->slug) }}"
                                        class="flex items-center px-4 py-2 rounded-lg {{ isset($currentCategory) && $currentCategory->id == $category->id ? 'bg-star-orange/20 text-star-orange border border-star-orange/30' : 'text-star-white-light hover:bg-night-light' }} transition-colors duration-300">
                                        <span>{{ $category->name }}</span>
                                        <span class="ml-auto bg-night-light px-2 py-1 rounded-full text-xs">
                                            {{ $category->posts_count }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Separador -->
                        <div class="w-full h-px bg-gradient-to-r from-transparent via-star-orange to-transparent my-6">
                        </div>

                        <!-- Últimos posts -->
                        <div>
                            <h4 class="title-star-orange text-lg mb-4">Recientes</h4>
                            <ul class="space-y-3">
                                @foreach ($recentPosts as $post)
                                    <li>
                                        <a href="{{ route('blog.show', $post->slug) }}"
                                            class="flex items-start space-x-3 group">
                                            <div class="flex-1">
                                                <h5
                                                    class="text-star-white group-hover:text-star-orange transition-colors duration-300">
                                                    {{ $post->title }}</h5>
                                                <p class="text-xs text-star-white-light/70">
                                                    {{ $post->created_at->format('d M Y') }}</p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="lg:w-3/4">

                    <!-- Lista de artículos -->
                    <div class="space-y-8">
                        @forelse($posts as $post)
                            <article
                                class="bg-night-grey rounded-lg overflow-hidden border border-night-light hover:border-star-orange/50 transition-colors duration-300">
                                <div class="p-6 md:p-8">
                                    <div class="flex flex-wrap items-center gap-2 mb-4">
                                        @foreach ($post->categories as $category)
                                            <span
                                                class="text-xs text-amber-100 bg-amber-100/10 px-2 py-1 rounded-full">{{ $category->name }}</span>
                                        @endforeach
                                        <span
                                            class="text-xs text-star-white-light/50">{{ $post->created_at->format('d M Y') }}</span>
                                    </div>

                                    <h2 class="title-star-white text-2xl md:text-3xl mb-4">
                                        <a href="{{ route('blog.show', $post->slug) }}"
                                            class="hover:text-amber-100 transition-colors duration-300">{{ $post->title }}</a>
                                    </h2>

                                    <div class="prose prose-invert max-w-none text-star-white-light mb-6">
                                        {!! nl2br(e(Str::limit($post->content, 200))) !!}
                                    </div>

                                    <a href="{{ route('blog.show', $post->slug) }}"
                                        class="inline-flex items-center text-amber-100 hover:text-amber-100-light transition-colors duration-300">
                                        Leer más
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="bg-night-grey rounded-lg border border-night-light p-8 text-center">
                                <svg class="w-16 h-16 text-star-orange/50 mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <h3 class="title-star-white text-xl mb-2">No hay artículos disponibles</h3>
                                <p class="text-star-white-light/70">Pronto habrá nuevo contenido en el blog.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Paginación -->
            @if ($posts->hasPages())
                <div class="mt-12">
                    {{ $posts->links('vendor.pagination.star-orange') }}
                    {{-- {{ $posts->links('vendor.pagination.star') }} --}}
                </div>
            @endif
        </div>
    </section>
@endsection
