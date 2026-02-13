<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'dni' => fake()->unique()->numerify('########'),
            'name' => fake()->name(),
            'dob' => fake()->date('Y-m-d', '-10 years'),
            'sex' => fake()->randomElement(['Masculino', 'Femenino']),
            'religion' => fake()->randomElement(['Católico', 'Cristiano', 'Otro']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('#########'),
            'address' => fake()->address(),
            'classesID' => 1,
            'sectionID' => 1,
            'roll' => fake()->numberBetween(100, 999),
            'library' => 0,
            'hostel' => 0,
            'transport' => 0,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => 1,
            'create_username' => 'admin',
            'create_usertype' => 'Admin',
            'active' => 1,
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('password'),
            'usertypeID' => 3,
            'createschoolyearID' => 1,
            'schoolyearID' => 1,
            'parentID' => 1,
        ];
    }
}
