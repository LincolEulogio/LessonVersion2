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
        Schema::create('payment', function (Blueprint $table) {
            $table->id('paymentID');
            $table->integer('schoolyearID');
            $table->integer('invoiceID');
            $table->integer('studentID');
            $table->double('paymentamount');
            $table->string('paymenttype', 40);
            $table->date('paymentdate');
            $table->string('paymentday', 10);
            $table->string('paymentmonth', 10);
            $table->year('paymentyear');
            $table->integer('userID');
            $table->integer('usertypeID');
            $table->string('uname', 60);
            $table->string('transactionID', 128)->nullable();
            $table->text('notice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
