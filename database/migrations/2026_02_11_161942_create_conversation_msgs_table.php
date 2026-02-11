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
        Schema::create('conversation_msg', function (Blueprint $table) {
            $table->id('msg_id');
            $table->integer('conversation_id');
            $table->integer('user_id');
            $table->string('subject')->nullable();
            $table->text('msg');
            $table->text('attach')->nullable();
            $table->text('attach_file_name')->nullable();
            $table->integer('usertypeID');
            $table->timestamp('create_date')->useCurrent();
            $table->timestamp('modify_date')->nullable();
            $table->integer('start')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_msgs');
    }
};
