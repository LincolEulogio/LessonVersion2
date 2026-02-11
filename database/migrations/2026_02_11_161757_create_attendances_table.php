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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id('attendanceID');
            $table->integer('schoolyearID');
            $table->integer('studentID');
            $table->integer('classesID');
            $table->integer('sectionID');
            $table->integer('userID');
            $table->string('usertype', 20);
            $table->string('monthyear', 10);
            for ($i = 1; $i <= 31; $i++) {
                $table->string("a$i", 3)->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
