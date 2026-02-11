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
        if (!Schema::hasTable('markpercentage')) {
            Schema::create('markpercentage', function (Blueprint $table) {
                $table->id('markpercentageID');
                $table->string('markpercentage', 100);
                $table->integer('markpercentage_numeric');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markpercentage');
    }
};
