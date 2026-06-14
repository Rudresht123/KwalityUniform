<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'password' => !empty($data['password']) ? Hash::make($data['password']) : null,
            'is_active' => $data['is_active'] ?? true,
        ]);

        $user->assignRole($data['role']);

        return $user;
    }

    public function update(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
            'is_active' => $data['is_active'] ?? $user->is_active,
        ]);

        if (!empty($data['password'])) {
            $user->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        if (!empty($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user->fresh();
    }

    public function deactivate(User $user): bool
    {
        return $user->update([
            'is_active' => false,
        ]);
    }

    public function activate(User $user): bool
    {
        return $user->update([
            'is_active' => true,
        ]);
    }
}
