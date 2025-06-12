@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex justify-center items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true">
                    <span class="px-4 py-2 border border-night-light rounded-md text-star-white-light/50 cursor-not-allowed">
                        « Anterior
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" 
                       class="px-4 py-2 border border-star-orange rounded-md text-star-orange hover:bg-star-orange hover:text-black transition-colors duration-300">
                        « Anterior
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true">
                        <span class="px-4 py-2 border border-night-light rounded-md text-star-white-light/50">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span class="px-4 py-2 border border-star-orange rounded-md bg-star-orange text-black">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" 
                                   class="px-4 py-2 border border-star-orange rounded-md text-star-orange hover:bg-star-orange hover:text-black transition-colors duration-300">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" 
                       class="px-4 py-2 border border-star-orange rounded-md text-star-orange hover:bg-star-orange hover:text-black transition-colors duration-300">
                        Siguiente »
                    </a>
                </li>
            @else
                <li aria-disabled="true">
                    <span class="px-4 py-2 border border-night-light rounded-md text-star-white-light/50 cursor-not-allowed">
                        Siguiente »
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif