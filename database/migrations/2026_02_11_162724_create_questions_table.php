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
        Schema::create('question', function (Blueprint $table) {
            $table->id('questionID');
            $table->integer('questionBankID');
            $table->text('question');
            $table->text('explanation')->nullable();
            $table->string('upload', 200)->nullable();
            $table->dateTime('create_date');
            $table->dateTime('modify_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
