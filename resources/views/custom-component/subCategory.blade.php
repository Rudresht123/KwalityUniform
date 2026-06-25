@php
    $id = $id ?? $name;
    $selected = $selected ?? '';

    $attributes = $attributes ?? [];

    $defaultClass = 'form-select select2';

    if (isset($attributes['class'])) {
        $attributes['class'] = $defaultClass . ' ' . $attributes['class'];
    } else {
        $attributes['class'] = $defaultClass;
    }
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
        {{ $placeholder ?? 'Select A Sub Catgory' }}
    </option>

    @foreach (subCategory([]) as $option)
        <option value="{{ $option->category_id }}" @selected($selected == $option->category_id)>
            {{ $option->category_name }}
        </option>
    @endforeach

</select>
