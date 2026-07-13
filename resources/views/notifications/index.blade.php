@extends('layouts.common')

@section('content')
<div class="col-xl-12">
    <div class="card custom-card">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div>
                    <h5 class="mb-0">Notifications</h5>
                    <small class="text-muted">
                        {{ $notifications->whereNull('read_at')->count() }} unread notifications
                    </small>
                </div>

                <button onclick="markNotificationAsRead(null)"
                    class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="ri-check-double-line me-1"></i>
                    Mark All Read
                </button>
            </div>
        </div>

        <div class="card-body p-0">

            @forelse($notifications as $notification)

                <div class="notification-row d-flex justify-content-between align-items-center px-4 py-3 border-bottom">

                    <div class="d-flex align-items-start">

                        {{-- Unread Indicator --}}
                        <div class="me-3 mt-2">
                            @if(!$notification->read_at)
                                <span class="notification-dot"></span>
                            @endif
                        </div>

                        {{-- Icon --}}
                        <div class="notification-icon me-3">
                            <i class="ri-notification-3-line"></i>
                        </div>

                        {{-- Content --}}
                        <div>
                            <div class="{{ !$notification->read_at ? 'fw-semibold text-dark' : 'text-muted' }}" style="font-size: 14px; line-height: 1.4;">
                                {{ $notification->data['message'] ?? 'New Notification' }}
                            </div>

                            <small class="text-muted" style="font-size: 11px;">
                                {{ $notification->created_at->format('d M Y, h:i A') }}
                            </small>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-2">

                        @if(isset($notification->data['url']))
                            <a href="{{ $notification->data['url'] }}"
                                class="btn btn-outline-primary btn-sm rounded-pill px-3" style="font-size: 12px;">
                                View
                            </a>
                        @endif

                        @if(!$notification->read_at)
                            <button
                                onclick="markNotificationAsRead('{{ $notification->id }}')"
                                class="btn btn-light btn-sm rounded-pill px-3" style="font-size: 12px;">
                                Read
                            </button>
                        @endif

                    </div>

                </div>

            @empty

                <div class="text-center py-5">
                    <img src="{{ asset('assets/images/no-data.svg') }}"
                        width="120"
                        class="mb-3 opacity-50">

                    <h6 class="fw-semibold">No Notifications Found</h6>

                    <p class="text-muted mb-0">
                        You don't have any notifications yet.
                    </p>
                </div>

            @endforelse

        </div>

        @if($notifications->count())
            <div class="card-footer">
                {{ $notifications->links() }}
            </div>
        @endif

    </div>
</div>

<style>
.notification-row{
    transition: all .2s ease;
    border-left: 3px solid transparent;
}

.notification-row:hover{
    background:#f8f9fa;
    border-left: 3px solid #0d6efd;
}

.notification-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    background:#0d6efd;
    display:block;
    box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.2);
}

.notification-icon{
    width:32px;
    height:32px;
    border-radius:8px;
    background:#eef4ff;
    color:#0d6efd;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
}
</style>

@endsection