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
        Schema::table('routine', function (Blueprint $table) {
            $table->string('create_username', 40)->after('create_usertypeID')->nullable();
            $table->string('create_usertype', 20)->after('create_username')->nullable();
            
            $table->dateTime('create_date')->nullable()->change();
            $table->dateTime('modify_date')->nullable()->change();
            $table->integer('create_userID')->nullable()->change();
            $table->integer('create_usertypeID')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routine', function (Blueprint $table) {
            $table->dropColumn(['create_username', 'create_usertype']);
        });
    }
};
