@forelse($notifications as $notification)

<a href="{{ $notification->data['url'] ?? '#' }}"
   class="dropdown-item">

    <div class="d-flex align-items-start">

        <div class="flex-fill">

            <p class="mb-1 fw-semibold">
                {{ $notification->data['message'] ?? 'New Notification' }}
            </p>

            <small class="text-muted">
                {{ $notification->created_at->diffForHumans() }}
            </small>

        </div>

    </div>

</a>

@empty

<div class="text-center p-3 text-muted">
    No new notifications
</div>

@endforelse