<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('absensi_log', function (Blueprint $table): void {
            $table->decimal('latitude_scan', 10, 7)->nullable()->change();
            $table->decimal('longitude_scan', 10, 7)->nullable()->change();
            $table->foreignId('qr_gerbang_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('absensi_log', function (Blueprint $table): void {
            $table->decimal('latitude_scan', 10, 7)->nullable(false)->change();
            $table->decimal('longitude_scan', 10, 7)->nullable(false)->change();
            $table->foreignId('qr_gerbang_id')->nullable(false)->change();
        });
    }
};
