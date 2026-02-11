<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productpurchaseitem', function (Blueprint $table) {
            $table->id('productpurchaseitemID');
            $table->integer('productpurchaseID');
            $table->integer('productID');
            $table->integer('productpurchaseitemquantity');
            $table->double('productpurchaseitemunitprice');
            $table->dateTime('create_date');
            $table->dateTime('modify_date');
            $table->integer('create_userID');
            $table->integer('create_usertypeID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productpurchaseitems');
    }
};
