<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\RolePermission\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\LogsAllActivity;
use Mckenziearts\Notify\Enums\NotificationModel;

#[Fillable(['name', 'username', 'email', 'avatar', 'phone', 'password', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasRoles,HasFactory, Notifiable, LogsAllActivity;

    /**
     * Get the user's avatar URL.
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Return professional UI Avatar with user initials
        return "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&background=6B62DD&color=fff&bold=true&size=128";
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the vendor associated with the user.
     */
    public function vendor()
    {
        return $this->hasOne(\App\Models\SuperAdmin\Vendor::class, 'user_id');
    }

    /**
     * Notification Data Getting
    */

}
