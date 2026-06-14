@props([
    'url' => '#',
    'title' => 'Edit Record',
    'modal' => 'editModal',
    'isModal' => false,
])

@if ($isModal)
    <button type="button" class="editUrl action-badge edit-badge" data-url="{{ $url }}"
        data-modalid="{{ $modal }}" data-bs-toggle="tooltip" title="{{ $title }}">

        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2">

            <path d="M12 20h9"></path>
            <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>

        </svg>

    </button>
@else
    <a href="{{ $url ?? '#' }}" class="action-badge edit-badge" data-bs-toggle="tooltip" title="{{ $title }}">

        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2">

            <path d="M12 20h9"></path>
            <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>

        </svg>

    </a>
@endif
