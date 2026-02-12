<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        // Create Admin User
        DB::table('users')->updateOrInsert(
            ['userID' => 1],
            [
                'dni' => '12345678',
                'name' => 'Admin User',
                'dob' => '1990-01-01',
                'sex' => 'Male',
                'email' => 'admin@example.com',
                'phone' => '987654321',
                'address' => 'Main St 123',
                'jod' => '2020-01-01',
                'username' => 'admin',
                'password' => $password,
                'usertypeID' => 1,
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Teacher in Users table
        DB::table('users')->updateOrInsert(
            ['userID' => 2],
            [
                'dni' => '22334455',
                'name' => 'John Doe',
                'dob' => '1985-05-15',
                'sex' => 'Male',
                'email' => 'john@example.com',
                'phone' => '999888777',
                'address' => 'Teacher Housing A',
                'jod' => '2021-02-10',
                'username' => 'john_teacher',
                'password' => $password,
                'usertypeID' => 2,
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Parent in Users table
        DB::table('users')->updateOrInsert(
            ['userID' => 3],
            [
                'dni' => '33445566',
                'name' => 'Jane Parent',
                'dob' => '1980-01-01',
                'sex' => 'Female',
                'email' => 'jane@example.com',
                'phone' => '111222333',
                'address' => 'Family Heights 45',
                'jod' => '2020-01-01',
                'username' => 'jane_parent',
                'password' => $password,
                'usertypeID' => 4,
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Student in Users table
        DB::table('users')->updateOrInsert(
            ['userID' => 4],
            [
                'dni' => '44556677',
                'name' => 'Jimmy Doe',
                'dob' => '2015-10-20',
                'sex' => 'Male',
                'email' => 'jimmy@example.com',
                'phone' => '123123123',
                'address' => 'Family Heights 45',
                'jod' => '2022-03-01',
                'username' => 'jimmy_student',
                'password' => $password,
                'usertypeID' => 3,
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Teacher in specialized table
        DB::table('teachers')->updateOrInsert(
            ['teacherID' => 1],
            [
                'dni' => '22334455',
                'name' => 'John Doe',
                'designation' => 'Senior Mathematics Teacher',
                'dob' => '1985-05-15',
                'sex' => 'Male',
                'email' => 'john@example.com',
                'phone' => '999888777',
                'address' => 'Teacher Housing A',
                'jod' => '2021-02-10',
                'username' => 'john_teacher',
                'password' => $password,
                'usertypeID' => 2,
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Parent in specialized table
        DB::table('parents')->updateOrInsert(
            ['parentsID' => 1],
            [
                'dni' => '33445566',
                'name' => 'Jane Parent',
                'father_name' => 'Grandpa Lee',
                'mother_name' => 'Grandma Lee',
                'father_profession' => 'Engineer',
                'mother_profession' => 'Doctor',
                'email' => 'jane@example.com',
                'phone' => '111222333',
                'address' => 'Family Heights 45',
                'username' => 'jane_parent',
                'password' => $password,
                'usertypeID' => 4,
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Student in specialized table
        DB::table('students')->updateOrInsert(
            ['studentID' => 1],
            [
                'dni' => '44556677',
                'name' => 'Jimmy Doe',
                'dob' => '2015-10-20',
                'sex' => 'Male',
                'email' => 'jimmy@example.com',
                'phone' => '123123123',
                'address' => 'Family Heights 45',
                'classesID' => 1,
                'sectionID' => 1,
                'roll' => 101,
                'bloodgroup' => 'O+',
                'country' => 'Peru',
                'registerNO' => 'REG1001',
                'state' => 'Lima',
                'library' => 0,
                'hostel' => 0,
                'transport' => 0,
                'parentID' => 1,
                'createschoolyearID' => 1,
                'schoolyearID' => 1,
                'username' => 'jimmy_student',
                'password' => $password,
                'usertypeID' => 3,
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_username' => 'admin',
                'create_usertype' => 'Admin',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
