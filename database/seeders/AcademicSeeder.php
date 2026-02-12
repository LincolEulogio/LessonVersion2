<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicSeeder extends Seeder
{
    public function run(): void
    {
        // Create Class
        DB::table('classes')->updateOrInsert(
            ['classesID' => 1],
            [
                'classes' => 'Primer Grado',
                'classes_numeric' => 1,
                'teacherID' => 1,
                'studentmaxID' => 30,
                'note' => 'Clase de primaria',
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Section
        DB::table('section')->updateOrInsert(
            ['sectionID' => 1],
            [
                'section' => 'A',
                'category' => 'Primaria',
                'capacity' => 30,
                'classesID' => 1,
                'teacherID' => 1,
                'note' => 'Sección A',
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_usertypeID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Subject
        DB::table('subject')->updateOrInsert(
            ['subjectID' => 1],
            [
                'classesID' => 1,
                'teacherID' => 1,
                'type' => 1,
                'passmark' => 11,
                'finalmark' => 20,
                'subject' => 'Matemáticas',
                'subject_author' => 'Ministerio de Educación',
                'subject_code' => 'MAT101',
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
