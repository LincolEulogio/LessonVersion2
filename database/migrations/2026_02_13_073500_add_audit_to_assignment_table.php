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
        Schema::table('assignment', function (Blueprint $table) {
            $table->string('create_username', 40)->after('schoolyearID')->nullable();
            $table->string('create_usertype', 20)->after('create_username')->nullable();
            
            // Re-evaluating structure for consistency with our audit system
            // In the original migration these were already present but let's make them nullable 
            // if they were not correctly handled.
            $table->integer('usertypeID')->nullable()->change();
            $table->integer('userID')->nullable()->change();
            $table->integer('schoolyearID')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignment', function (Blueprint $table) {
            $table->dropColumn(['create_username', 'create_usertype']);
        });
    }
};
