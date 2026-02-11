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
        Schema::create('tattendance', function (Blueprint $table) {
            $table->id('tattendanceID');
            $table->integer('schoolyearID');
            $table->integer('teacherID');
            $table->integer('usertypeID');
            $table->string('monthyear', 20);
            for ($i = 1; $i <= 31; $i++) {
                $table->string("a$i", 10)->nullable();
            }
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
        Schema::dropIfExists('tattendance');
    }
};
