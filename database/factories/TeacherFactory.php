<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'dni' => fake()->unique()->numerify('########'),
            'name' => fake()->name(),
            'designation' => fake()->jobTitle(),
            'dob' => fake()->date('Y-m-d', '-25 years'),
            'sex' => fake()->randomElement(['Masculino', 'Femenino']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('#########'),
            'address' => fake()->address(),
            'jod' => fake()->date(),
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('password'),
            'usertypeID' => 2,
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
