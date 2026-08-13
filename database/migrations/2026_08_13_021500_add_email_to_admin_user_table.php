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
        Schema::table('admin_user', function (Blueprint $table) {
            if (! Schema::hasColumn('admin_user', 'email')) {
                $table->string('email')->unique()->after('username');
            }

            if (! Schema::hasColumn('admin_user', 'remember_token')) {
                $table->rememberToken()->after('role');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_user', function (Blueprint $table) {
            if (Schema::hasColumn('admin_user', 'email')) {
                $table->dropColumn('email');
            }

            if (Schema::hasColumn('admin_user', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
        });
    }
};
