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
        Schema::create('productpurchase', function (Blueprint $table) {
            $table->id('productpurchaseID');
            $table->integer('productsupplierID');
            $table->string('productpurchasereferenceno', 128);
            $table->date('productpurchasedate');
            $table->text('productpurchasedesc')->nullable();
            $table->double('productpurchasegrandtotal');
            $table->double('productpurchasepaidamount');
            $table->double('productpurchaserefundpaymentamount')->nullable();
            $table->integer('productpurchasestatus');
            $table->integer('productpurchasestep');
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
        Schema::dropIfExists('productpurchases');
    }
};
