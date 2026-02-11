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
        Schema::create('event', function (Blueprint $table) {
            $table->id('eventID');
            $table->date('fdate');
            $table->time('ftime');
            $table->date('tdate');
            $table->time('ttime');
            $table->string('title', 128);
            $table->text('details');
            $table->string('photo', 200)->nullable();
            $table->timestamp('create_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
