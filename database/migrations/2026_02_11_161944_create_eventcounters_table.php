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
        Schema::create('eventcounter', function (Blueprint $table) {
            $table->id('eventcounterID');
            $table->integer('eventID');
            $table->string('username', 40);
            $table->string('type', 20);
            $table->string('name', 128);
            $table->string('photo', 200)->nullable();
            $table->integer('status');
            $table->timestamp('create_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventcounters');
    }
};
