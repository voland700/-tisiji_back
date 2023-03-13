@if ($paginator->hasPages())
    <div class="bx-pagination bx-yellow">
        <div class="bx-pagination-container row">
            <ul>
            @if ($paginator->onFirstPage())
                <li class="bx-pag-prev"><span>Назад</span></li>
            @else
                 <li class="bx-pag-prev"><a href="{{ $paginator->previousPageUrl() }}"><span>Назад</span></a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item dormant"></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="bx-active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}"><span>{{ $page }}</span></a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="bx-pag-next"><a href="{{ $paginator->nextPageUrl() }}"><span>Вперед</span></a></li>
             @else
                <li class="bx-pag-next"><span>Вперед</span></li>
            @endif
            </ul>
            <div style="clear:both"></div>
        </div>
    </div>
@endif
