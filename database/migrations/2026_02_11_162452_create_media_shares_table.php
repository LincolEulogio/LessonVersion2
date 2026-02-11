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
        Schema::create('media_share', function (Blueprint $table) {
            $table->id('media_shareID');
            $table->integer('mediaID');
            $table->integer('share_userID');
            $table->integer('share_usertypeID');
            $table->dateTime('create_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_shares');
    }
};
