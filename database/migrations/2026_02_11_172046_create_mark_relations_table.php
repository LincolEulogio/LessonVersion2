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
        if (!Schema::hasTable('markrelation')) {
            Schema::create('markrelation', function (Blueprint $table) {
                $table->id('markrelationID');
                $table->integer('markID'); // FK to marks table
                $table->integer('markpercentageID'); // FK to markpercentage table
                $table->string('mark', 20)->nullable(); // The actual score for this component
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markrelation');
    }
};
