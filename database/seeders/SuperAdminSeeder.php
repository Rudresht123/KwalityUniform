<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
    $user = User::updateOrCreate(

        [
            'email' => 'rudershtiwari8@gmail.com',
        ],

        [
            'name' => 'Super Admin',

            'phone' => '9999999999',

            'password' => Hash::make('Admin@123'),

            'is_active' => true,

            'email_verified_at' => now(),

            'phone_verified_at' => now(),
        ]
    );

    $user->syncRoles(['super-admin']);
}
}