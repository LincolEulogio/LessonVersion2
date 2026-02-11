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
        Schema::create('visitorinfo', function (Blueprint $table) {
            $table->id('visitorinfoID');
            $table->string('name', 128);
            $table->string('email_id', 128)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('company', 128)->nullable();
            $table->string('coming_from', 128)->nullable();
            $table->string('whom_to_meet', 128);
            $table->integer('usertypeID');
            $table->integer('userID');
            $table->string('check_in', 60);
            $table->string('check_out', 60)->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('visitorinfo');
    }
};
