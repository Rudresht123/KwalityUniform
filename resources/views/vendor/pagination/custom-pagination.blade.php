@if ($paginator->hasPages())
<div class="premium-pagination-wrapper">
    <div class="pagination-info">
        <span>
            Showing
            <strong>{{ $paginator->firstItem() }}</strong>
            -
            <strong>{{ $paginator->lastItem() }}</strong>
            of
            <strong>{{ $paginator->total() }}</strong>
            Products
        </span>
    </div>

    <nav>
        <ul class="pagination premium-pagination">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>

                        @else

                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>

                        @endif

                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
            @endif

        </ul>
    </nav>
</div>
@endif


<style>
    /* ===============================
   Premium Pagination
==================================*/

.premium-pagination-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:35px;
    flex-wrap:wrap;
    gap:20px;
}

.pagination-info{
    color:#6b7280;
    font-size:15px;
}

.pagination-info strong{
    color:#111827;
}

.premium-pagination{

    display:flex;
    gap:10px;
    margin:0;
    padding:0;
}

.premium-pagination .page-item{

    list-style:none;
}

.premium-pagination .page-link{

    width:44px;
    height:44px;

    border-radius:14px;

    border:1px solid #e5e7eb;

    background:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    color:#374151;

    font-weight:600;

    text-decoration:none;

    transition:.25s ease;

    box-shadow:0 5px 15px rgba(0,0,0,.05);
}

.premium-pagination .page-link:hover{

    transform:translateY(-3px);

    color:#fff;

    border-color:#2563eb;

    background:linear-gradient(135deg,#3b82f6,#2563eb);

    box-shadow:0 10px 25px rgba(37,99,235,.30);

}

.premium-pagination .page-item.active .page-link{

    background:linear-gradient(135deg,#2563eb,#1d4ed8);

    border:none;

    color:#fff;

    box-shadow:0 12px 30px rgba(37,99,235,.35);

}

.premium-pagination .page-item.disabled .page-link{

    background:#f9fafb;

    color:#cbd5e1;

    cursor:not-allowed;

    box-shadow:none;

    opacity:.7;
}

.premium-pagination .page-item.disabled .page-link:hover{

    transform:none;

    background:#f9fafb;

    color:#cbd5e1;

}

@media(max-width:768px){

.premium-pagination-wrapper{

flex-direction:column;

align-items:center;

text-align:center;

}

.pagination-info{

font-size:14px;

}

.premium-pagination{

gap:7px;

}

.premium-pagination .page-link{

width:38px;

height:38px;

border-radius:10px;

font-size:14px;

}

}
</style>