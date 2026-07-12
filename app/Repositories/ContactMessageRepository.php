<?php

namespace App\Repositories;

use App\Models\ContactMessage;
use Illuminate\Support\Collection;

class ContactMessageRepository
{
    /**
     * Get the latest support tickets from contact messages.
     */
    public function getLatestTickets(int $limit = 10)
    {
        return ContactMessage::latest()->take($limit)->get();
    }
}
