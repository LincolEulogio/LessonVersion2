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
        Schema::create('media_category', function (Blueprint $table) {
            $table->id('media_categoryID');
            $table->integer('userID');
            $table->integer('usertypeID');
            $table->string('folder_name', 128);
            $table->dateTime('create_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_categories');
    }
};
