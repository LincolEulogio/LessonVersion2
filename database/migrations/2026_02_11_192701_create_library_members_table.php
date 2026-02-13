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
        if (!Schema::hasTable('lmember')) {
            Schema::create('lmember', function (Blueprint $table) {
                $table->id('lmemberID');
                $table->string('lmembercardID', 40);
                $table->unsignedBigInteger('studentID');
                $table->string('name', 60);
                $table->string('email', 40)->nullable();
                $table->string('phone', 20)->nullable();
                $table->string('lbalance', 20)->nullable();
                $table->date('ljoindate');
                $table->timestamps();
                
                $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lmember');
    }
};
