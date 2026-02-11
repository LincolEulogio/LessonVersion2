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
        Schema::create('leaveapp', function (Blueprint $table) {
            $table->id('leaveappID');
            $table->integer('applicant_id');
            $table->integer('applicant_usertypeID');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('leave_days', 10);
            $table->date('application_date');
            $table->dateTime('create_date');
            $table->integer('categoryID');
            $table->text('reason')->nullable();
            $table->integer('status');
            $table->string('attachment', 200)->nullable();
            $table->integer('schoolyearID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaveapps');
    }
};
