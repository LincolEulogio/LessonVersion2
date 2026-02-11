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
        Schema::create('studentextend', function (Blueprint $table) {
            $table->id('studentextendID');
            $table->integer('studentID');
            $table->integer('classesID');
            $table->integer('sectionID');
            $table->integer('roll');
            $table->integer('library')->default(0);
            $table->integer('hostel')->default(0);
            $table->integer('transport')->default(0);
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
        Schema::dropIfExists('studentextends');
    }
};
