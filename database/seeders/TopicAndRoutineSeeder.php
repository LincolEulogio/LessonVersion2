<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicAndRoutineSeeder extends Seeder
{
    public function run(): void
    {
        // Topics
        DB::table('topics')->updateOrInsert(
            ['topicID' => 1],
            [
                'title' => 'Álgebra Básica',
                'description' => 'Introducción a variables y expresiones algebraicas.',
                'classesID' => 1,
                'subjectID' => 1,
                'create_userID' => 1,
                'create_usertype' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Routines (Horarios)
        DB::table('routine')->updateOrInsert(
            ['routineID' => 1],
            [
                'classesID' => 1,
                'sectionID' => 1,
                'subjectID' => 1,
                'teacherID' => 1,
                'schoolyearID' => 1,
                'day' => 'Monday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Aula 101',
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_usertypeID' => 1,
            ]
        );
    }
}
