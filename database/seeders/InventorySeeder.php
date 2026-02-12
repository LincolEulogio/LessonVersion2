<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        // Category
        DB::table('productcategory')->updateOrInsert(
            ['productcategoryID' => 1],
            [
                'productcategoryname' => 'Útiles Escolares',
                'productcategorydesc' => 'Cuadernos, lápices, etc.',
                'create_date' => now(),
                'modify_date' => now(),
                'create_userID' => 1,
                'create_usertypeID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Product
        DB::table('product')->updateOrInsert(
            ['productID' => 1],
            [
                'productcategoryID' => 1,
                'productname' => 'Cuaderno A4',
                'productdesc' => 'Cuaderno cuadriculado de 100 hojas',
                'productbuyprice' => 3.50,
                'productsaleprice' => 5.00,
                'productinitquantity' => 100,
                'productquantity' => 100,
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
