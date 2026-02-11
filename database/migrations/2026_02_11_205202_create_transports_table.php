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
        Schema::create('transports', function (Blueprint $table) {
            $table->id('transportID');
            $table->string('route', 128);
            $table->string('vehicle', 128);
            $table->decimal('cost', 10, 2);
            $table->string('note', 200)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('modify_date')->nullable();
            $table->unsignedBigInteger('create_userID');
            $table->unsignedBigInteger('create_usertypeID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
