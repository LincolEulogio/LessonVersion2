<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('schoolyear')->updateOrInsert(
            ['schoolyearID' => 1],
            [
                'schoolyear' => '2025-2026',
                'schoolyeartitle' => 'Academic Year 2025-2026',
                'startingdate' => '2025-01-01',
                'endingdate' => '2025-12-31',
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_usertypeID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
