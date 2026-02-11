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
        Schema::create('conversation_user', function (Blueprint $table) {
            $table->integer('conversation_id');
            $table->integer('user_id');
            $table->integer('usertypeID');
            $table->integer('is_sender')->default(0);
            $table->integer('trash')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_users');
    }
};
