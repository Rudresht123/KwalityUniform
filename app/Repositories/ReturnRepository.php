<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class ReturnRepository
{
    /**
     * Get latest return requests.
     */
    public function getReturnRequests(int $limit = 10)
    {
        return \App\Models\OrderReturn::latest()->take($limit)->get();
    }

    /**
     * Get total count of returns.
     */
    public function getTotalReturnsCount(): int
    {
        return \App\Models\OrderReturn::count();
    }
}
