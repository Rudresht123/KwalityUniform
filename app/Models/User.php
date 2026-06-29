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

#[Fillable(['name', 'username', 'email', 'avatar', 'logo_url', 'phone', 'password', 'is_active', 'image_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasRoles, HasFactory, Notifiable, LogsAllActivity;

    /**
     * Get the user's avatar URL.
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->image_id) {
            return $this->file->url;
        }

        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Return professional UI Avatar with user initials
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=6B62DD&color=fff&bold=true&size=128';
    }

    public function file()
    {
        return $this->belongsTo(\App\Models\File::class, 'image_id');
    }

    public function userLogo()
    {
        if ($this->hasRole('Vendor')) {
            $vendor = $this->vendor;
            if ($vendor && $vendor->image_id) {
                return $vendor->file->url;
            }
            return $vendor && $vendor->logo_url ? getFileUrl($vendor->logo_url) : false;
        }

        if ($this->hasRole('School')) {
            $school = $this->school;
            if ($school && $school->image_id) {
                return $school->file->url;
            }
            return $school && $school->logo_url ? getFileUrl($school->logo_url) : false;
        }

        // Super Admin / Admin
        if ($this->image_id) {
            return $this->file->url;
        }
        return $this->logo_url ? getFileUrl($this->logo_url) : false;
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
     * Get the school associated with the user.
     */
    public function school()
    {
        return $this->hasOne(\App\Models\SuperAdmin\School::class, 'user_id');
    }

    /**
     * Notification Data Getting
     */
}
