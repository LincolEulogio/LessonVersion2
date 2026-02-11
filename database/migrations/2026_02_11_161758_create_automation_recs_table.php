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
        Schema::create('automation_rec', function (Blueprint $table) {
            $table->id('automation_recID');
            $table->integer('studentID');
            $table->date('date');
            $table->string('day', 3);
            $table->string('month', 3);
            $table->year('year');
            $table->integer('nofmodule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automation_recs');
    }
};
