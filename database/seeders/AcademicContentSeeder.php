<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicContentSeeder extends Seeder
{
    public function run(): void
    {
        // Create Assignment
        DB::table('assignment')->updateOrInsert(
            ['assignmentID' => 1],
            [
                'title' => 'Tarea de Fracciones',
                'description' => 'Realizar los ejercicios de la página 45.',
                'deadlinedate' => now()->addDays(7),
                'usertypeID' => 2, // Teacher
                'userID' => 1,
                'originalfile' => 'fracciones.pdf',
                'file' => 'fracciones_123.pdf',
                'classesID' => '1',
                'schoolyearID' => 1,
                'sectionID' => '1',
                'subjectID' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Syllabus
        DB::table('syllabus')->updateOrInsert(
            ['syllabusID' => 1],
            [
                'title' => 'Plan de Matemáticas Q1',
                'description' => 'Temas a tratar en el primer trimestre.',
                'classesID' => 1,
                'file' => 'syllabus_mat.pdf',
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
