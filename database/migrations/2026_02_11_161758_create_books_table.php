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
        if (!Schema::hasTable('book')) {
            Schema::create('book', function (Blueprint $table) {
                $table->id('bookID');
                $table->string('book', 60);
                $table->tinyText('subject_code');
                $table->string('author', 100);
                $table->integer('price');
                $table->integer('quantity');
                $table->integer('due_quantity');
                $table->tinyText('rack');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
