<?php

namespace App\Models\SuperAdmin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parent extends Model
{
    use SoftDeletes;

    protected $table = 'parents';

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'state',
        'zip_code',
        'alternate_phone',
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
