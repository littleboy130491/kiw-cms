@php
if (! isset($scrollTo)) {
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
        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
            <ul class="flex flex-row flex-wrap justify-center gap-2">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="flex items-center justify-center" aria-disabled="true"
                        aria-label="{{ __('pagination.previous') }}">
                        <span class="px-3 py-1 border border-[var(--color-heading)] rounded opacity-50">
                            {!! __('pagination.previous') !!}
                        </span>
                    </li>
                @else
                    <li class="flex items-center justify-center">
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="px-3 py-1 border border-[var(--color-heading)] hover:bg-[var(--color-blue)] hover:text-white hover:border-[var(--color-blue)] rounded cursor-pointer">
                            {!! __('pagination.previous') !!}
                        </button>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="flex items-center justify-center" aria-disabled="true">
                            <span class="px-3 py-1 border border-[var(--color-heading)] rounded">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="flex items-center justify-center" aria-current="page">
                                    <div class="current-page px-3 py-1 bg-[var(--color-blue)] rounded text-white">
                                        {{ $page }}
                                    </div>
                                </li>
                            @else
                                <li class="flex items-center justify-center">
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                        class="px-3 py-1 border border-[var(--color-heading)] hover:bg-[var(--color-blue)] hover:text-white hover:border-[var(--color-blue)] rounded cursor-pointer">
                                        {{ $page }}
                                    </button>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="flex items-center justify-center">
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="px-3 py-1 border border-[var(--color-heading)] hover:bg-[var(--color-blue)] hover:text-white hover:border-[var(--color-blue)] rounded cursor-pointer">
                            {!! __('pagination.next') !!}
                        </button>
                    </li>
                @else
                    <li class="flex items-center justify-center" aria-disabled="true"
                        aria-label="{{ __('pagination.next') }}">
                        <span class="px-3 py-1 border border-[var(--color-heading)] rounded opacity-50">
                            {!! __('pagination.next') !!}
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
