<?php

namespace App\Models\RolePermission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

use App\Traits\LogsAllActivity;

class Role extends SpatieRole
{
    use HasFactory,SoftDeletes, LogsAllActivity;

    protected $fillable = [
        'name',
        'role_category',
        'guard_name',
    ];
}