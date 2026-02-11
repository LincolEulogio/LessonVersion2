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
        Schema::create('eattendance', function (Blueprint $table) {
            $table->id('eattendanceID');
            $table->integer('schoolyearID');
            $table->integer('examID');
            $table->integer('classesID');
            $table->integer('sectionID');
            $table->integer('subjectID');
            $table->date('date');
            $table->integer('studentID')->nullable();
            $table->string('s_name', 60)->nullable();
            $table->string('eattendance', 20)->nullable();
            $table->year('year');
            $table->string('eextra', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eattendances');
    }
};
