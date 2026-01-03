@if ($paginator->hasPages())
	<nav aria-label="Page navigation" class="mt-4 mb-0 pt-2">
        <ul class="pagination tbr_pagination m-auto">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item {{ $service_id }}_link tbr_disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item {{ $service_id }}_link">
                    <a class="page-link" href="{{ route('order.step-2', ['service_id' => $service_id, 'page' => $paginator->currentPage()-1 ]) }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item {{ $service_id }}_link tbr_disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item {{ $service_id }}_link tbr_active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item {{ $service_id }}_link"><a class="page-link" href="{{ route('order.step-2', ['service_id' => $service_id, 'page' => $page ]) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item {{ $service_id }}_link">
                    <a class="page-link" href="{{ route('order.step-2', ['service_id' => $service_id, 'page' => $paginator->currentPage()+1 ]) }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item tbr_disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

{{-- BACKUP --}}

{{-- @if ($paginatedData->lastPage() > 1)
	<nav aria-label="Page navigation" class="mt-4 mb-0 pt-2">
		<ul class="pagination tbr_pagination m-auto justify-content-center">
			<li class="page-item {{ $service_id }}_link {{ ($paginatedData->currentPage() == 1) ? ' tbr_disabled' : '' }}">
				<a class="page-link" href="{{ route('order.step-2', ['service_id' => $service_id, 'page' => $paginatedData->currentPage()-1 ]) }}">
					<img src="{{ asset('/assets/svg/icons/icon_paginate_prev.svg') }}" alt="Previous">
				</a>
			</li>
			@for ($i = 1; $i <= $paginatedData->lastPage(); $i++)
				<li class="page-item {{ $service_id }}_link {{ ($paginatedData->currentPage() == $i) ? ' tbr_active' : '' }}">
					<a class="page-link" href="{{ route('order.step-2', ['service_id' => $service_id, 'page' => $i ]) }}">{{ $i }}</a>
				</li>
			@endfor
			<li class="page-item {{ $service_id }}_link {{ ($paginatedData->currentPage() == $paginatedData->lastPage()) ? ' tbr_disabled' : '' }}">
				<a class="page-link" href="{{ route('order.step-2', ['service_id' => $service_id, 'page' => $paginatedData->currentPage()+1 ]) }}">
					<img src="{{ asset('/assets/svg/icons/icon_paginate_next.svg') }}" alt="Next">
				</a>
			</li>
		</ul>
	</nav>
@endif --}}