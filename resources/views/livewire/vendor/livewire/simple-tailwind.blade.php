@php
if (! isset($scrollTo)) {
$scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
? <<<JS
    (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '' ;
    @endphp

    <div>
    @if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1">
            @if ($paginator->onFirstPage())
            <span class="pagination-prev disabled">Previous</span>
            @else
            <button wire:click="previousPage" class="pagination-prev">Previous</button>
            @endif

            @if ($paginator->hasMorePages())
            <button wire:click="nextPage" class="pagination-next">Next</button>
            @else
            <span class="pagination-next disabled">Next</span>
            @endif
        </div>
    </nav>
    @endif

    </div>