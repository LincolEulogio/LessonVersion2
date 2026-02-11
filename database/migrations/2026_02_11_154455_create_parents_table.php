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
        Schema::create('parents', function (Blueprint $table) {
            $table->id('parentsID');
            $table->string('dni', 60);
            $table->string('name', 60);
            $table->string('father_name', 60);
            $table->string('mother_name', 60);
            $table->string('father_profession', 40);
            $table->string('mother_profession', 40);
            $table->string('email', 40)->nullable();
            $table->tinyText('phone')->nullable();
            $table->text('address')->nullable();
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
