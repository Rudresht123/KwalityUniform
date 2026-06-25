@php
    $id = $id ?? $name;
    $selected = $selected ?? '';
    $placeholder = $placeholder ?? 'Select';

    $attributes = $attributes ?? [];

    $defaultClass = 'form-select select2';

    $attributes['class'] = isset($attributes['class']) ? $defaultClass . ' ' . $attributes['class'] : $defaultClass;

@endphp

<select id="{{ $id }}" name="{{ $name }}"
    @foreach ($attributes as $key => $value)

    @if (is_bool($value))

        @if ($value)
            {{ $key }}
        @endif

    @else

        {{ $key }}="{{ $value }}"

    @endif @endforeach>

    <option value="">
        {{ $placeholder }}
    </option>

    @foreach (vendors([]) as $option)
        <option value="{{ $option->vendor_id }}" @selected($selected == $option->vendor_id)>
            {{ $option->business_name }}    
        </option>
    @endforeach



</select>


