<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users') || Schema::hasColumn('users', 'current_team_id')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('current_team_id')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'current_team_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('current_team_id');
            });
        }
    }
};
