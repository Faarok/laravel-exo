@if($paginator->hasPages())
    <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
        <a href="{{ $paginator->previousPageUrl() }}" @class(['pagination-previous', 'is-disabled' => $paginator->onFirstPage()]) aria-label="@lang('pagination.previous')">
            <i class="fas fa-angle-left"></i>
        </a>

        <a href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')" @class(['pagination-previous', 'is-disabled' => $paginator->hasMorePages()])>
            <i class="fas fa-angle-right"></i>
        </a>

        <ul class="pagination-list">
            @if($paginator->currentPage() !== 1)
                <li>
                    <a href="{{ $paginator->url(1) }}" @class([
                        'pagination-link',
                        'is-current' => $paginator->currentPage() == 1
                    ])>1</a>
                </li>
            @endif

            @if($paginator->currentPage() > 3)
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            @endif

            @if($paginator->currentPage() > 1 && $paginator->currentPage() - 1 !== 1)
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="pagination-link">{{ $paginator->currentPage() - 1 }}</a>
                </li>
            @endif

            <li>
                <span class="pagination-link is-current">{{ $paginator->currentPage() }}</span>
            </li>

            @if($paginator->currentPage() < $paginator->lastPage() && $paginator->currentPage() + 1 !== $paginator->lastPage())
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="pagination-link">{{ $paginator->currentPage() + 1 }}</a>
                </li>
            @endif

            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            @endif

            @if($paginator->lastPage() > 1 && $paginator->currentPage() !== $paginator->lastPage())
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pagination-link {{ $paginator->currentPage() == $paginator->lastPage() ? 'is-current' : '' }}">{{ $paginator->lastPage() }}</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
