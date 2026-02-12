<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialSeeder extends Seeder
{
    public function run(): void
    {
        // Invoice
        DB::table('invoice')->updateOrInsert(
            ['invoiceID' => 1],
            [
                'schoolyearID' => 1,
                'classesID' => 1,
                'studentID' => 1,
                'feetypesID' => 1,
                'feetypes' => 'Pensión Marzo',
                'amount' => 500.00,
                'discount' => 0.00,
                'paidamount' => 500.00,
                'status' => 1, // Paid
                'date' => now()->format('Y-m-d'),
                'create_date' => now()->format('Y-m-d'),
                'day' => now()->format('d'),
                'month' => now()->format('m'),
                'year' => now()->format('Y'),
                'paidstatus' => 2,
                'userID' => 1,
                'usertypeID' => 1,
                'uname' => 'Admin User',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
