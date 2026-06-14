@props([
    'url' => '#',
    'title' => 'View Details',
    'modal' => 'showModal',
    'isModal' => false,
])

@if ($isModal)
    <button type="button"
        class="showUrl action-badge view-badge"
        data-url="{{ $url }}"
        data-modalid="{{ $modal }}"
        data-bs-toggle="tooltip"
        title="{{ $title }}">

        <svg xmlns="http://www.w3.org/2000/svg"
            width="14"
            height="14"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <path d="M12 4c-5 0-9.27 3.11-11 8c1.73 4.89 6 8 11 8s9.27-3.11 11-8c-1.73-4.89-6-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>

        </svg>

    </button>
@else
    <a href="{{ $url }}"
        class="action-badge view-badge"
        data-bs-toggle="tooltip"
        title="{{ $title }}">

        <svg xmlns="http://www.w3.org/2000/svg"
            width="14"
            height="14"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <path d="M12 4c-5 0-9.27 3.11-11 8c1.73 4.89 6 8 11 8s9.27-3.11 11-8c-1.73-4.89-6-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>

        </svg>

    </a>
@endif