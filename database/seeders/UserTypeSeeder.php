<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['usertypeID' => 1, 'usertype' => 'Admin'],
            ['usertypeID' => 2, 'usertype' => 'Teacher'],
            ['usertypeID' => 3, 'usertype' => 'Student'],
            ['usertypeID' => 4, 'usertype' => 'Parent'],
            ['usertypeID' => 5, 'usertype' => 'Accountant'],
            ['usertypeID' => 6, 'usertype' => 'Librarian'],
            ['usertypeID' => 7, 'usertype' => 'Receptionist'],
        ];

        foreach ($types as $type) {
            DB::table('usertypes')->updateOrInsert(
                ['usertypeID' => $type['usertypeID']],
                array_merge($type, [
                    'create_date' => now(),
                    'modify_date' => now(),
                    'create_userID' => 1,
                    'create_username' => 'admin',
                    'create_usertype' => 'Admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
