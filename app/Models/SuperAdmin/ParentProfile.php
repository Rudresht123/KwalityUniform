<?php

namespace App\Models\SuperAdmin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentProfile extends Model
{
    use SoftDeletes;

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
     * Get the user that owns this parent profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
