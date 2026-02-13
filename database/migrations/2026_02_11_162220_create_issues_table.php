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
        if (!Schema::hasTable('issue')) {
            Schema::create('issue', function (Blueprint $table) {
                $table->id('issueID');
                $table->string('lmembercardID', 128);
                $table->unsignedBigInteger('bookID');
                $table->string('serial_no', 40);
                $table->date('issue_date');
                $table->date('due_date');
                $table->date('return_date')->nullable();
                $table->text('note')->nullable();
                $table->timestamps();

                $table->foreign('bookID')->references('bookID')->on('book')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue');
    }
};
