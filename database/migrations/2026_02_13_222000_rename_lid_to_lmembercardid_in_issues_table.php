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
        Schema::table('issue', function (Blueprint $table) {
            if (Schema::hasColumn('issue', 'lID') && !Schema::hasColumn('issue', 'lmembercardID')) {
                $table->renameColumn('lID', 'lmembercardID');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue', function (Blueprint $table) {
            if (Schema::hasColumn('issue', 'lmembercardID') && !Schema::hasColumn('issue', 'lID')) {
                $table->renameColumn('lmembercardID', 'lID');
            }
        });
    }
};
