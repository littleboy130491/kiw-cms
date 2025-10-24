@php
    if (!isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
               (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
            JS
        : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation"
            class="flex items-center justify-center w-full px-2 sm:px-4">
            <div class="w-full max-w-full overflow-x-auto scrollbar-hide">
                <div class="mx-auto inline-flex items-center whitespace-nowrap text-base font-medium py-2 gap-2">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span
                            class="inline-flex items-center justify-center px-2 sm:px-2.5 py-1 text-sm sm:text-base rounded-md opacity-40 cursor-default">
                            <span class="hidden sm:inline">{!! __('pagination.previous') !!}</span>
                            <span class="sm:hidden">Prev</span>
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="inline-flex items-center justify-center px-2 sm:px-2.5 py-1 text-sm sm:text-base rounded-md cursor-pointer transition-colors hover:text-[var(--color-blue)] active:scale-95">
                            <span class="hidden sm:inline">{!! __('pagination.previous') !!}</span>
                            <span class="sm:hidden">Prev</span>
                        </button>
                    @endif

                    <div class="inline-flex items-center gap-1">
                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span
                                    class="inline-flex items-center justify-center w-7 sm:w-8 py-1 text-sm sm:text-base rounded-md">{{ $element }}</span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <span
                                            class="inline-flex items-center justify-center w-7 sm:w-8 py-1 text-sm sm:text-base rounded-md text-[var(--color-blue)] font-semibold">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                            class="inline-flex items-center justify-center w-7 sm:w-8 py-1 text-sm sm:text-base rounded-md cursor-pointer transition-colors hover:text-[var(--color-blue)] active:scale-95">
                                            {{ $page }}
                                        </button>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="inline-flex items-center justify-center px-2 sm:px-2.5 py-1 text-sm sm:text-base rounded-md cursor-pointer transition-colors hover:text-[var(--color-blue)] active:scale-95">
                            <span class="hidden sm:inline">{!! __('pagination.next') !!}</span>
                            <span class="sm:hidden">Next</span>
                        </button>
                    @else
                        <span
                            class="inline-flex items-center justify-center px-2 sm:px-2.5 py-1 text-sm sm:text-base rounded-md opacity-40 cursor-default">
                            <span class="hidden sm:inline">{!! __('pagination.next') !!}</span>
                            <span class="sm:hidden">Next</span>
                        </span>
                    @endif
                </div>
            </div>
        </nav>
    @endif
</div>