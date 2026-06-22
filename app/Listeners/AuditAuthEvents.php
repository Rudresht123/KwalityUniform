<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Spatie\Activitylog\Facades\Activity;

class AuditAuthEvents
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event instanceof Login) {
            activity('auth')
                ->causedBy($event->user)
                ->performedOn($event->user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log('User logged in');
        } elseif ($event instanceof Logout) {
            if ($event->user) {
                activity('auth')
                    ->causedBy($event->user)
                    ->performedOn($event->user)
                    ->withProperties([
                        'ip' => request()->ip(),
                        'user_agent' => request()->userAgent(),
                    ])
                    ->log('User logged out');
            }
        }
    }
}
