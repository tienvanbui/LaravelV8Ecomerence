@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li> --}}

                <a aria-disabled="true" aria-label="@lang('pagination.previous')" class="flex-c-m how-pagination1 trans-04 m-all-7 page-item disabled" aria-hidden="true">
						&lsaquo;
				</a>
            @else
                {{-- <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> --}}
                 <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="flex-c-m how-pagination1 trans-04 m-all-7 page-link">
								&lsaquo;
				</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                            <li class="page-item" aria-current="page"><a class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1 page-link">
								{{ $page }}
							</a></li>
                        @else
                            {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                             <li class="page-item" aria-current="page"><a href="{{ $url }}" class="flex-c-m how-pagination1 trans-04 m-all-7 page-link">
								{{ $page }}
							</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}

                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="flex-c-m how-pagination1 trans-04 m-all-7 page-link">
								&rsaquo;
				</a>
            @else
                {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    {{-- <span class="page-link" aria-hidden="true">&rsaquo;</span> --}}
                    {{-- <a aria-hidden="true" class="flex-c-m how-pagination1 trans-04 m-all-7 page-link">&rsaquo;</a> --}}
                {{-- </li>  --}}

                <a aria-disabled="true" aria-label="@lang('pagination.previous')" class="flex-c-m how-pagination1 trans-04 m-all-7 page-item disabled" aria-hidden="true">
						&rsaquo;
				</a>
            @endif
        </ul>
    </nav>
@endif
