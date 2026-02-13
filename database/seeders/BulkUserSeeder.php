<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Database\Seeder;

class BulkUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed 40 Users (Employees: Accountant, Librarian, Receptionist)
        User::factory()->count(40)->create();

        // 2. Seed 40 Teachers
        Teacher::factory()->count(40)->create();

        // 3. Seed 40 Parents
        $parents = Parents::factory()->count(40)->create();

        // 4. Seed 40 Students and link them to parents
        foreach (range(1, 40) as $index) {
            Student::factory()->create([
                'parentID' => $parents->random()->parentsID,
                'roll' => 1000 + $index, // Ensure unique-ish rolls
            ]);
        }
    }
}
