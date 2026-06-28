<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\LogsAllActivity;

class WebUser extends Model
{
    use SoftDeletes, LogsAllActivity;

    protected $table = 'web_users';

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'state',
        'zip_code',
        'alternate_phone',
        'gender',
        'date_of_birth',
        'national_id',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'notes',
    ];

    /**
     * Get the user associated with the web user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
