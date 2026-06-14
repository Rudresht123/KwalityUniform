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
        'guard_name',
    ];
}