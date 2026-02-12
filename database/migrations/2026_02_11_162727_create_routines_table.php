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
        Schema::create('routine', function (Blueprint $table) {
            $table->id('routineID');
            $table->integer('classesID');
            $table->integer('sectionID');
            $table->integer('subjectID');
            $table->integer('teacherID');
            $table->integer('schoolyearID');
            $table->string('day', 20);
            $table->string('start_time', 10);
            $table->string('end_time', 10);
            $table->string('room', 64);
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
        Schema::dropIfExists('routines');
    }
};
