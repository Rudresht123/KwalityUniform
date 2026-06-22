<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\LogsAllActivity;

class EmailLog extends Model
{
    use LogsAllActivity;

    protected $table = 'email_logs';

    protected $fillable = [

        'template_key',

        'recipient',

        'subject',

        'status',

        'error_message',

        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];
}