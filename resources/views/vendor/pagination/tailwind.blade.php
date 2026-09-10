@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-ink-soft/50 border border-line rounded-sm">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm text-ink-soft border border-line rounded-sm hover:border-forest hover:text-ink transition">Previous</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm text-ink-soft border border-line rounded-sm hover:border-forest hover:text-ink transition">Next</a>
            @else
                <span class="px-4 py-2 text-sm text-ink-soft/50 border border-line rounded-sm">Next</span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-ink-soft">
                    {!! __('Showing') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div class="flex gap-1">
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-1.5 text-sm text-ink-soft/40 border border-line rounded-sm">&laquo;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-ink-soft border border-line rounded-sm hover:border-forest hover:text-ink transition">&laquo;</a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 py-1.5 text-sm text-ink-soft/50">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-1.5 text-sm bg-forest text-paper rounded-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1.5 text-sm text-ink-soft border border-line rounded-sm hover:border-forest hover:text-ink transition">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-ink-soft border border-line rounded-sm hover:border-forest hover:text-ink transition">&raquo;</a>
                @else
                    <span class="px-3 py-1.5 text-sm text-ink-soft/40 border border-line rounded-sm">&raquo;</span>
                @endif
            </div>
        </div>
    </nav>
@endif
