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
        Schema::create('mailandsmstemplate', function (Blueprint $table) {
            $table->id('mailandsmstemplateID');
            $table->integer('usertypeID');
            $table->string('type', 10);
            $table->text('template');
            $table->dateTime('create_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailandsmstemplate');
    }
};
