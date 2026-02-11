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
        Schema::create('site', function (Blueprint $table) {
            $table->id('siteID');
            $table->string('title', 128);
            $table->string('tagline', 128);
            $table->string('email', 128);
            $table->string('phone', 20);
            $table->text('address');
            $table->string('footer', 128);
            $table->string('logo', 200)->nullable();
            $table->string('favicon', 200)->nullable();
            $table->string('currency_code', 20);
            $table->string('currency_symbol', 20);
            $table->string('google_analytics', 128)->nullable();
            $table->string('language', 20);
            $table->integer('automation');
            $table->dateTime('create_date');
            $table->dateTime('modify_date');
            $table->integer('create_userID');
            $table->integer('create_usertypeID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
