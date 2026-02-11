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
        Schema::create('mailandsms', function (Blueprint $table) {
            $table->id('mailandsmsID');
            $table->integer('usertypeID');
            $table->integer('user_id');
            $table->string('type', 10);
            $table->text('message');
            $table->year('year');
            $table->dateTime('create_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailandsms');
    }
};
