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
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'remember_token')) {
                $table->rememberToken();
            }
        });

        Schema::table('teachers', function (Blueprint $table) {
            if (!Schema::hasColumn('teachers', 'remember_token')) {
                $table->rememberToken();
            }
        });

        Schema::table('parents', function (Blueprint $table) {
            if (!Schema::hasColumn('parents', 'remember_token')) {
                $table->rememberToken();
            }
        });

        Schema::table('systemadmins', function (Blueprint $table) {
            if (!Schema::hasColumn('systemadmins', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });

        Schema::table('parents', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });

        Schema::table('systemadmins', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
};
