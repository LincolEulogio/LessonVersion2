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
        Schema::create('productsale', function (Blueprint $table) {
            $table->id('productsaleID');
            $table->string('productsalereferenceno', 128);
            $table->integer('productsalecustomerid');
            $table->integer('productsalecustertypeid');
            $table->date('productsaledate');
            $table->text('productsaledesc')->nullable();
            $table->double('productsalegrandtotal');
            $table->double('productsalepaidamount');
            $table->double('productsalerefundpaymentamount')->nullable();
            $table->integer('productsalestatus');
            $table->integer('productsalestep');
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
        Schema::dropIfExists('productsales');
    }
};
