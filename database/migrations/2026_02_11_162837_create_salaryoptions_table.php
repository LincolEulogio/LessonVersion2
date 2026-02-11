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
        Schema::create('salaryoption', function (Blueprint $table) {
            $table->id('salaryoptionID');
            $table->integer('salary_templateID');
            $table->string('label', 128);
            $table->string('value', 20);
            $table->string('type', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaryoptions');
    }
};
