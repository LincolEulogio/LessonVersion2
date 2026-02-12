<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunicationSeeder extends Seeder
{
    public function run(): void
    {
        // Create Conversation
        DB::table('conversations')->updateOrInsert(
            ['id' => 1],
            [
                'status' => 0,
                'draft' => 0,
                'fav_status' => 0,
                'create_date' => now(),
                'modify_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Link users to conversation (assuming user 1 and user 2 exist)
        // User 1 is admin, User 2 could be teacher (we created teacher with teacherID=1, but in users table it might be different)
        // Let's check UserSeeder again. I only created Admin in users table. 
        // I should also add the Teacher to the users table in UserSeeder.

        DB::table('conversation_user')->updateOrInsert(
            ['conversation_id' => 1, 'user_id' => 1],
            [
                'usertypeID' => 1,
                'is_sender' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Message
        DB::table('conversation_msg')->updateOrInsert(
            ['msg_id' => 1],
            [
                'conversation_id' => 1,
                'user_id' => 1,
                'subject' => 'Bienvenida',
                'msg' => 'Bienvenido al sistema escolar.',
                'usertypeID' => 1,
                'create_date' => now(),
                'modify_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Media
        DB::table('media')->updateOrInsert(
            ['mediaID' => 1],
            [
                'userID' => 1,
                'usertypeID' => 1,
                'm_name' => 'Logo Escuela',
                'file_name' => 'logo.png',
                'file_type' => 'image/png',
                'create_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
