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
        Schema::create('promotionlog', function (Blueprint $table) {
            $table->id('promotionlogID');
            $table->integer('studentID');
            $table->integer('classesID');
            $table->integer('sectionID');
            $table->integer('roll');
            $table->integer('schoolyearID');
            $table->integer('promotion_classesID');
            $table->integer('promotion_sectionID');
            $table->integer('promotion_roll');
            $table->integer('promotion_schoolyearID');
            $table->dateTime('create_date');
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
        Schema::dropIfExists('promotionlogs');
    }
};
