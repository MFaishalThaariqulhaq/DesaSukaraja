@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    <style>
        .pagination-wrap {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .pagination-item {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #475569;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            text-decoration: none;
            min-width: 2.75rem;
        }

        .pagination-item:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .pagination-item.active {
            background: #059669;
            color: #fff;
            border-color: #059669;
            font-weight: 600;
        }

        .pagination-item.disabled {
            opacity: 0.55;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination-item svg {
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
                display: flex;
                width: 100%;
                justify-content: space-between;
                gap: 0.5rem;
            }
        }
    </style>

    <div class="pagination-info sm:hidden">
        @if ($paginator->onFirstPage())
        <span class="pagination-item disabled">
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            <span>Sebelumnya</span>
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-item">
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            <span>Sebelumnya</span>
        </a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-item">
            <span>Selanjutnya</span>
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
        </a>
        @else
        <span class="pagination-item disabled">
            <span>Selanjutnya</span>
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
        </span>
        @endif
    </div>

    <div class="hidden w-full sm:block">
        <div class="pagination-wrap">
            @if ($paginator->onFirstPage())
            <span class="pagination-item disabled">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                <span>Sebelumnya</span>
            </span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" class="pagination-item">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                <span>Sebelumnya</span>
            </a>
            @endif

            @foreach ($elements as $element)
            @if (is_string($element))
            <span class="pagination-item disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <span class="pagination-item active">{{ $page }}</span>
            @else
            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="pagination-item">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" class="pagination-item">
                <span>Selanjutnya</span>
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </a>
            @else
            <span class="pagination-item disabled">
                <span>Selanjutnya</span>
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </span>
            @endif
        </div>
    </div>
</nav>
@endif
