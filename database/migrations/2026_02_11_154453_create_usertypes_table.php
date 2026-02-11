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
        Schema::create('usertypes', function (Blueprint $table) {
            $table->id('usertypeID');
            $table->string('usertype', 60);
            $table->dateTime('create_date')->useCurrent();
            $table->dateTime('modify_date')->useCurrent();
            $table->integer('create_userID');
            $table->string('create_username', 40);
            $table->string('create_usertype', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usertypes');
    }
};
