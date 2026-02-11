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
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni', 60)->nullable()->change();
            $table->date('dob')->nullable()->change();
            $table->string('sex', 10)->nullable()->change();
            $table->date('jod')->nullable()->change();
            $table->integer('usertypeID')->default(1)->change(); // Default to Admin/Staff
            $table->dateTime('create_date')->nullable()->change();
            $table->dateTime('modify_date')->nullable()->change();
            $table->integer('create_userID')->nullable()->change();
            $table->string('create_username', 40)->nullable()->change();
            $table->string('create_usertype', 20)->nullable()->change();
            $table->integer('active')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni', 60)->nullable(false)->change();
            $table->date('dob')->nullable(false)->change();
            $table->string('sex', 10)->nullable(false)->change();
            $table->date('jod')->nullable(false)->change();
            $table->integer('usertypeID')->nullable(false)->change();
            $table->dateTime('create_date')->nullable(false)->change();
            $table->dateTime('modify_date')->nullable(false)->change();
            $table->integer('create_userID')->nullable(false)->change();
            $table->string('create_username', 40)->nullable(false)->change();
            $table->string('create_usertype', 20)->nullable(false)->change();
            $table->integer('active')->nullable(false)->change();
        });
    }
};
