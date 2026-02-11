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
        Schema::create('automation_shudulu', function (Blueprint $table) {
            $table->id('automation_shuduluID');
            $table->date('date');
            $table->string('day', 3);
            $table->string('month', 3);
            $table->year('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automation_shudulus');
    }
};
