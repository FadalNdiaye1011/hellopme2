@if ($paginator->hasPages())
    <nav class="mb-4 flex justify-center space-x-4" aria-label="Pagination">
        {{-- Lien vers la page précédente --}}
        @if ($paginator->onFirstPage())
            <span class="rounded-lg border border-[#677B44] px-2 py-2 text-gray-700">
                <svg class="mt-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="rounded-lg border border-[#677B44] px-2 py-2 text-gray-700">
                <svg class="mt-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @endif

        {{-- Liens de pages --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="rounded-lg border border-[#677B44] px-4 py-2 text-gray-700">{{ $element }}</span>
            @endif

            {{-- Liens de pages --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="rounded-lg border border-[#677B44] bg-[#677B44] px-4 py-2 text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="rounded-lg border border-[#677B44] px-4 py-2 text-gray-700">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Lien vers la page suivante --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="rounded-lg border border-[#677B44] px-2 py-2 text-gray-700">
                <svg class="mt-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @else
            <span class="rounded-lg border border-[#677B44] px-2 py-2 text-gray-700">
            <svg class="mt-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
            aria-hidden="true">
            <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd">
            </path>
        </svg>
            </span>
        @endif
    </nav>
@endif
