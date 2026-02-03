@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    <style>
        /* Pagination styling - match galeri */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .pagination-wrap a,
        .pagination-wrap span {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .pagination-wrap a:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .pagination-wrap .active span {
            background: #059669;
            color: white;
            border-color: #059669;
        }

        .pagination-wrap .disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-wrap svg {
            width: 1rem;
            height: 1rem;
        }

        .pagination-info {
            display: none;
        }

        @media (max-width: 640px) {
            .pagination-wrap {
                display: none;
            }
            .pagination-info {
                display: block;
            }
        }
    </style>

    <!-- Mobile view - simplified -->
    <div class="pagination-info flex justify-between w-full sm:hidden">
        @if ($paginator->onFirstPage())
        <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md">
            {!! __('pagination.previous') !!}
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
            {!! __('pagination.previous') !!}
        </a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
            {!! __('pagination.next') !!}
        </a>
        @else
        <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md">
            {!! __('pagination.next') !!}
        </span>
        @endif
    </div>

    <!-- Desktop view - full pagination -->
    <div class="hidden w-full sm:block">
        <div class="pagination-wrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <span class="disabled">
                <span><svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></span>
            </span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <span class="active">
                <span>{{ $page }}</span>
            </span>
            @else
            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                {{ $page }}
            </a>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </a>
            @else
            <span class="disabled">
                <span><svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg></span>
            </span>
            @endif
        </div>
    </div>
</nav>
@endif