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
        Schema::create('hmember', function (Blueprint $table) {
            $table->id('hmemberID');
            $table->integer('hostelID');
            $table->integer('categoryID');
            $table->integer('studentID');
            $table->string('hbalance', 20)->nullable();
            $table->date('hjoindate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hmembers');
    }
};
