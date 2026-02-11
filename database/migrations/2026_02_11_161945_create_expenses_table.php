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
        Schema::create('expense', function (Blueprint $table) {
            $table->id('expenseID');
            $table->date('create_date');
            $table->date('date');
            $table->string('expenseday', 11);
            $table->string('expensemonth', 11);
            $table->year('expenseyear');
            $table->string('expense', 128);
            $table->double('amount');
            $table->integer('userID');
            $table->integer('usertypeID');
            $table->string('uname', 40);
            $table->integer('schoolyearID');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
