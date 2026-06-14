@props([
    'url' => '#',
    'title' => 'Delete Record',
])

<button type="button"
        class="deleteBtn action-badge delete-badge"
        data-url="{{ $url }}"
        data-bs-toggle="tooltip"
        title="{{ $title }}">

    <svg xmlns="http://www.w3.org/2000/svg"
         width="14"
         height="14"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2">

        <polyline points="3 6 5 6 21 6"></polyline>
        <path d="M19 6l-1 14H6L5 6"></path>
        <path d="M10 11v6"></path>
        <path d="M14 11v6"></path>
        <path d="M9 6V4h6v2"></path>

    </svg>

</button>