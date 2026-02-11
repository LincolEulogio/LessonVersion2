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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID');
            $table->string('dni', 60);
            $table->string('name', 60);
            $table->date('dob');
            $table->string('sex', 10);
            $table->string('email', 40)->nullable();
            $table->tinyText('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('jod');
            $table->string('photo', 200)->nullable();
            $table->string('username', 40);
            $table->string('password', 128);
            $table->integer('usertypeID');
            $table->dateTime('create_date');
            $table->dateTime('modify_date');
            $table->integer('create_userID');
            $table->string('create_username', 40);
            $table->string('create_usertype', 20);
            $table->integer('active');
            $table->rememberToken(); // Standard Laravel Auth
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
