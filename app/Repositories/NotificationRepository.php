<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class NotificationRepository
{
    /**
     * Get recent system notifications.
     */
    public function getRecentNotifications(int $limit = 8, $userId = null): Collection
    {
        $query = DB::table('notifications')->latest();

        if ($userId) {
            $query->where('notifiable_id', $userId);
        }

        return $query->take($limit)->get()->map(function($note) {
            $data = json_decode($note->data, true);
            return [
                'description' => $data['message'] ?? $data['description'] ?? 'System Notification',
                'created_at' => $note->created_at,
                'type' => $note->type,
            ];
        });
    }
}
