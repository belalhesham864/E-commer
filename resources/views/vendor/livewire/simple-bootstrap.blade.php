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
        <nav class="d-flex align-items-center justify-content-between px-2 py-1 border-top mt-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <button class="btn btn-sm btn-outline-secondary" disabled style="opacity:0.4; cursor:not-allowed; border-radius:50px;">
                    <i class="ft-chevron-left"></i> Prev
                </button>
            @else
                @if(method_exists($paginator,'getCursorName'))
                    @php($previousCursor = $paginator->previousCursor() ?? $paginator->cursor())
                    <button
                        class="btn btn-sm btn-outline-primary"
                        style="border-radius:50px;"
                        wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $previousCursor?->encode() }}"
                        wire:click="setPage('{{ $previousCursor?->encode() }}','{{ $paginator->getCursorName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled">
                        <i class="ft-chevron-left"></i> Prev
                    </button>
                @else
                    <button
                        class="btn btn-sm btn-outline-primary"
                        style="border-radius:50px;"
                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled">
                        <i class="ft-chevron-left"></i> Prev
                    </button>
                @endif
            @endif

            {{-- Page indicator --}}
            <span class="text-muted font-small-2">
                Page {{ $paginator->currentPage() }}
            </span>

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                @if(method_exists($paginator,'getCursorName'))
                    @php($nextCursor = $paginator->nextCursor() ?? $paginator->cursor())
                    <button
                        class="btn btn-sm btn-outline-primary"
                        style="border-radius:50px;"
                        dusk="nextPage"
                        wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $nextCursor?->encode() }}"
                        wire:click="setPage('{{ $nextCursor?->encode() }}','{{ $paginator->getCursorName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled">
                        Next <i class="ft-chevron-right"></i>
                    </button>
                @else
                    <button
                        class="btn btn-sm btn-outline-primary"
                        style="border-radius:50px;"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled">
                        Next <i class="ft-chevron-right"></i>
                    </button>
                @endif
            @else
                <button class="btn btn-sm btn-outline-secondary" disabled style="opacity:0.4; cursor:not-allowed; border-radius:50px;">
                    Next <i class="ft-chevron-right"></i>
                </button>
            @endif

        </nav>
    @endif
</div>
