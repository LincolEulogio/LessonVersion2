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
        Schema::create('examschedule', function (Blueprint $table) {
            $table->id('examscheduleID');
            $table->integer('examID');
            $table->integer('classesID');
            $table->integer('sectionID');
            $table->integer('subjectID');
            $table->date('edate');
            $table->string('examfrom', 10);
            $table->string('examto', 10);
            $table->tinyText('room')->nullable();
            $table->integer('schoolyearID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examschedules');
    }
};
