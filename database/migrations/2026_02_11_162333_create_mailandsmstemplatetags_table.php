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
        Schema::create('mailandsmstemplatetag', function (Blueprint $table) {
            $table->id('mailandsmstemplatetagID');
            $table->integer('mailandsmstemplateID');
            $table->string('tagname', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailandsmstemplatetags');
    }
};
