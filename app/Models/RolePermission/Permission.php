<?php

namespace App\Models\RolePermission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

use App\Traits\LogsAllActivity;

class Permission extends SpatiePermission
{
    use HasFactory, LogsAllActivity;

    protected $fillable = [
        'name',
        'permission_name',
        'group_name',
        'role_category',
        'parent_id',
        'guard_name',
    ];

    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}