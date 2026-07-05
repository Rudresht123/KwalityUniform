<?php

namespace Database\Factories\SuperAdmin;

use App\Models\RolePermission\Role;
use App\Models\User;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    public function definition(): array
    {
        $statusOptions = ['pending', 'approved', 'suspended'];

        $businessName = $this->faker->unique()->company();

        $user = User::factory()->create([
            'name' => $businessName,
        ]);
        $admin = User::first();

        $vendorRole = Role::findByName('vendor');
        $user->assignRole($vendorRole);
        return [
            'vendor_id' => Str::uuid()->toString(),

            'user_id' => $user->id,
            'email' => $this->faker->unique()->safeEmail(),

            'business_name' => $businessName,

            'phone' => $this->faker->unique()->numerify('##########'),

            'owner_name' => $this->faker->name(),

            'address' => $this->faker->streetAddress(),

            'city' => $this->faker->city(),

            'state' => $this->faker->state(),

            'pincode' => $this->faker->postcode(),

            'gstin' => strtoupper($this->faker->numerify('12') . $this->faker->lexify('?????') . $this->faker->numerify('####') . $this->faker->lexify('?') . 'Z' . $this->faker->bothify('?')),

            'pan_number' => strtoupper($this->faker->lexify('?????') . $this->faker->numerify('####') . $this->faker->lexify('?')),

            'bank_account_no' => $this->faker->numerify('##############'),

            'ifsc_code' => strtoupper($this->faker->lexify('AAAA') . '0' . $this->faker->bothify('######')),

            'commission_rate' => $this->faker->randomFloat(2, 0, 20),

            'status' => $this->faker->randomElement($statusOptions),

            'logo_url' => null,

            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
