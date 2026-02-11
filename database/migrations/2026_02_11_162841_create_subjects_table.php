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
        Schema::create('subject', function (Blueprint $table) {
            $table->id('subjectID');
            $table->integer('classesID');
            $table->integer('teacherID');
            $table->integer('type');
            $table->integer('passmark');
            $table->integer('finalmark');
            $table->string('subject', 60);
            $table->string('subject_author', 128)->nullable();
            $table->string('subject_code', 128);
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
        Schema::dropIfExists('subjects');
    }
};
