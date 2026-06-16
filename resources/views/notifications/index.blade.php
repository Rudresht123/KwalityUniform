@extends('layouts.common')

@section('content')
<div class="col-lg-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">All Notifications</div>
            <div>
                <button onclick="markNotificationAsRead(null)" class="btn btn-light btn-sm border">
                    Mark all as read
                </button>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse($notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center {{ $notification->read_at ? 'bg-light' : '' }}">
                        <div>
                            <p class="mb-0 {{ $notification->read_at ? 'text-muted' : 'fw-bold' }}">
                                {{ $notification->data['message'] ?? 'New Notification' }}
                            </p>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="btn-list">
                            @if(!$notification->read_at)
                                <button onclick="markNotificationAsRead('{{ $notification->id }}')" class="btn btn-sm btn-primary-transparent">
                                    Mark as read
                                </button>
                            @endif
                            @if(isset($notification->data['url']))
                                <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-info-transparent">
                                    View Link
                                </a>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center p-5">
                        <p class="text-muted mb-0">No notifications found.</p>
                    </li>
                @endforelse
            </ul>
            
            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
