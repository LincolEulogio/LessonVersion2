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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id('invoiceID');
            $table->integer('schoolyearID');
            $table->integer('classesID');
            $table->integer('studentID');
            $table->integer('feetypesID');
            $table->string('feetypes', 60);
            $table->double('amount');
            $table->double('discount')->nullable();
            $table->double('paidamount')->nullable();
            $table->integer('status');
            $table->date('date');
            $table->date('create_date');
            $table->string('day', 10);
            $table->string('month', 10);
            $table->year('year');
            $table->integer('paidstatus')->nullable();
            $table->integer('userID')->nullable();
            $table->integer('usertypeID')->nullable();
            $table->string('uname', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
