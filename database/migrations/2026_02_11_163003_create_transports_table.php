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
        if (!Schema::hasTable('transport')) {
            Schema::create('transport', function (Blueprint $table) {
            $table->id('transportID');
            $table->string('route', 128);
            $table->string('vehicle', 60);
            $table->string('cost', 20);
            $table->text('note')->nullable();
            $table->dateTime('create_date');
            $table->dateTime('modify_date');
            $table->integer('create_userID');
            $table->integer('create_usertypeID');
            $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
