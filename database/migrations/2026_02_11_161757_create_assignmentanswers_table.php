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
        Schema::create('assignmentanswer', function (Blueprint $table) {
            $table->id('assignmentanswerID');
            $table->integer('assignmentID');
            $table->integer('schoolyearID');
            $table->integer('uploaderID');
            $table->integer('uploadertypeID');
            $table->text('answerfile');
            $table->text('answerfileoriginal');
            $table->date('answerdate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignmentanswers');
    }
};
