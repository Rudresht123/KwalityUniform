<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Record
{
    protected $fillable = [
        'key',
        'title',
        'message',
        'type',
        'icon',
        'channels',
        'created_by',
        'updated_by'
    ];

protected $casts = [
    'channels' => 'array',
];
}