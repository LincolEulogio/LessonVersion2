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
        Schema::table('media', function (Blueprint $table) {
            $table->integer('mcategoryID')->default(0)->after('mediaID');
        });

        Schema::table('media_share', function (Blueprint $table) {
             $table->integer('classesID')->default(0);
             $table->integer('public')->default(0);
             $table->integer('file_or_folder')->default(0)->comment('0: file, 1: folder');
             $table->integer('item_id')->default(0);
             $table->integer('mediaID')->nullable()->change(); // Make nullable as item_id takes over
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('mcategoryID');
        });

        Schema::table('media_share', function (Blueprint $table) {
            $table->dropColumn(['classesID', 'public', 'file_or_folder', 'item_id']);
             $table->integer('mediaID')->nullable(false)->change();
        });
    }
};
