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
            $table->string('day', 60);
            $table->string('start_time', 10);
            $table->string('end_time', 10);
            $table->string('room', 10);
            $table->integer('schoolyearID');
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
