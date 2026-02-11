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
        Schema::create('productsupplier', function (Blueprint $table) {
            $table->id('productsupplierID');
            $table->string('productsuppliername', 128);
            $table->string('productsuppliercompanyname', 128)->nullable();
            $table->string('productsupplierphone', 20)->nullable();
            $table->string('productsupplieremail', 60)->nullable();
            $table->text('productsupplieraddress')->nullable();
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
        Schema::dropIfExists('productsuppliers');
    }
};
