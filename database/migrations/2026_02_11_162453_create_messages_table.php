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
        Schema::create('message', function (Blueprint $table) {
            $table->id('messageID');
            $table->string('email', 128)->nullable();
            $table->string('subject', 128)->nullable();
            $table->text('message');
            $table->integer('status');
            $table->date('date');
            $table->dateTime('create_date');
            $table->integer('userID');
            $table->integer('usertypeID');
            $table->string('uname', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
