@php

    $items = explode('|', $breadcrumb ?? 'Home');

@endphp
<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        
        <h2 class="main-content-title fs-24 mb-1">{{ $title ?? 'Welcome To Dashboard' }}</h2>
        <ol class="breadcrumb mb-0">
            @foreach ($items as $item)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">

                        {{ $item }}

                    </li>
                @else
                    <li class="breadcrumb-item">

                        <a href="javascript:void(0)">

                            {{ $item }}

                        </a>

                    </li>
                @endif
            @endforeach
        </ol>
    </div>

</div>







</ol>
