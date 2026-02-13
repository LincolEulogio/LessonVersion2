<?php

namespace Database\Factories;

use App\Models\Parents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ParentsFactory extends Factory
{
    protected $model = Parents::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'father_name' => fake()->name('male'),
            'mother_name' => fake()->name('female'),
            'father_profession' => fake()->jobTitle(),
            'mother_profession' => fake()->jobTitle(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('#########'),
            'address' => fake()->address(),
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('password'),
            'usertypeID' => 4,
            'dni' => fake()->unique()->numerify('########'),
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => 1,
            'create_username' => 'admin',
            'create_usertype' => 'Admin',
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
