@php

    $isActive = filter_var($value, FILTER_VALIDATE_BOOLEAN);

    $class = $isActive
        ? 'bg-success'
        : 'bg-danger';

    $label = $isActive
        ? 'Active'
        : 'Inactive';

@endphp

<span class="badge {{ $class }}">
    {{ $label }}
</span>