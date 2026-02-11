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
        Schema::create('loginlog', function (Blueprint $table) {
            $table->id('loginlogID');
            $table->integer('userID');
            $table->string('name', 60);
            $table->string('usertype', 40);
            $table->string('ip', 45);
            $table->string('browser', 128);
            $table->string('operatingsystem', 128);
            $table->string('loginID', 128);
            $table->dateTime('loggedin_at');
            $table->dateTime('loggedout_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loginlogs');
    }
};
