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
        Schema::create('assignment', function (Blueprint $table) {
            $table->id('assignmentID');
            $table->string('title', 128);
            $table->text('description');
            $table->date('deadlinedate');
            $table->integer('usertypeID');
            $table->integer('userID');
            $table->text('originalfile');
            $table->text('file');
            $table->longText('classesID');
            $table->integer('schoolyearID');
            $table->longText('sectionID')->nullable();
            $table->longText('subjectID')->nullable();
            $table->integer('assignusertypeID')->nullable();
            $table->integer('assignuserID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
