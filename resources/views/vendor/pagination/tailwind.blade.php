@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="paginator-nav">
 
        <p class="paginator-nav__showing font-medium">
            <span class="font-medium">Mostrando</span>
            @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            <span class="font-medium">a</span>
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            @else
            {{ $paginator->count() }}
            @endif
            <span class="font-medium">de</span>
            <span class="font-medium">{{ $paginator->total() }}</span>
            <span class="font-medium">resultados</span>
        </p>
    

    <div class="paginator-nav__header">
        @if ($paginator->onFirstPage())
        <span class="paginator-nav__firstpage">
            {!! __('pagination.previous') !!}
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="paginator-nav__not-firstpage ">
            {!! __('pagination.previous') !!}
        </a>
        @endif

        {{-- LAs paginas --}}
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <span aria-disabled="true">
            <span class="paginator-nav__threedots">{{
                $element }}</span>
        </span>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span aria-current="page">
            <span class="paginator-nav__currentpage">
                {{$page }}
            </span>
        </span>
        @else
        <a href="{{ $url }}" class="paginator-nav__page" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
            {{ $page }}
        </a>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="paginator-nav__nextpage">
            {!! __('pagination.next') !!}
        </a>
        @else
        <span class="paginator-nav__not-nextpage ">
            {!! __('pagination.next') !!}
        </span>
        @endif
    </div>


</nav>
@endif