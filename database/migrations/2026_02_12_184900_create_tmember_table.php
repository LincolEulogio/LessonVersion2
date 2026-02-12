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
        if (!Schema::hasTable('tmember')) {
            Schema::create('tmember', function (Blueprint $table) {
                $table->id('tmemberID');
                $table->integer('studentID');
                $table->integer('transportID');
                $table->string('tbalance', 20)->nullable();
                $table->date('tjoindate');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmember');
    }
};
