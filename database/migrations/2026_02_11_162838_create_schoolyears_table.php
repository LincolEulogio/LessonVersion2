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
        Schema::create('schoolyear', function (Blueprint $table) {
            $table->id('schoolyearID');
            $table->string('schoolyear', 128);
            $table->string('schoolyeartitle', 128)->nullable();
            $table->string('startingdate', 128)->nullable();
            $table->string('endingdate', 128)->nullable();
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
        Schema::dropIfExists('schoolyears');
    }
};
