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
        Schema::create('lmember', function (Blueprint $table) {
            $table->id('lmemberID');
            $table->string('lmembercardID', 60);
            $table->integer('studentID');
            $table->string('name', 60);
            $table->string('email', 60)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('lbalance', 20)->nullable();
            $table->date('ljoindate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lmembers');
    }
};
