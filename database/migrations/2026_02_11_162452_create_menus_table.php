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
        Schema::create('menu', function (Blueprint $table) {
            $table->id('menuID');
            $table->string('menuName', 128);
            $table->integer('menuIDParent')->default(0);
            $table->string('menuLink', 128);
            $table->string('menuIcon', 128)->nullable();
            $table->integer('menuPriority')->default(0);
            $table->integer('menuStatus')->default(1);
            $table->dateTime('menuCreateDate');
            $table->integer('menuCreatedBy');
            $table->integer('menuDeleted')->default(0);
            $table->dateTime('menuDeletedAt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
