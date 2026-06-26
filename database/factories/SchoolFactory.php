<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\SuperAdmin\School;

use Illuminate\Support\Str;

class SchoolFactory extends Factory
{
    protected $model = School::class;

    public function definition(): array
    {
        $schoolName = $this->faker->unique()->company() . ' School';
    $admin = User::first();

       
        return [

            'school_id' => Str::uuid()->toString(),

            'user_id' => User::factory([
                'name' => $schoolName,
            ]),

        
            'school_name' => $schoolName,

            'principal_name' => $this->faker->name(),

            'phone' => $this->faker->unique()->numerify('##########'),

            'email'=>$this->faker->email(),

            'address' => $this->faker->address(),

            'city' => $this->faker->city(),

            'state' => $this->faker->state(),

            'pincode' => $this->faker->numerify('######'),

            'affiliation_no' => strtoupper(
                $this->faker->bothify('CBSE#######')
            ),

            'logo_url' => null,

            'is_active' => $this->faker->randomElement([
                '1',
                '0',
            ]),

            'created_by' => $admin?->id,
        'updated_by' => $admin?->id,
        ];
    }
       public function configure(): static
    {
        return $this->afterCreating(function ($school) {

            $school->user->assignRole('school');

        });
    }
}