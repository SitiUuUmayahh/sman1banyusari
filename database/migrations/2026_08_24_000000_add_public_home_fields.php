<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            if (! Schema::hasColumn('berita', 'kategori')) {
                $table->string('kategori')->nullable()->after('gambar_cover');
            }
        });

        Schema::table('halaman_statis', function (Blueprint $table) {
            if (! Schema::hasColumn('halaman_statis', 'jumlah_siswa_aktif')) {
                $table->unsignedInteger('jumlah_siswa_aktif')->nullable()->after('konten');
            }
        });
    }

    public function down(): void
    {
        Schema::table('halaman_statis', function (Blueprint $table) {
            if (Schema::hasColumn('halaman_statis', 'jumlah_siswa_aktif')) {
                $table->dropColumn('jumlah_siswa_aktif');
            }
        });

        Schema::table('berita', function (Blueprint $table) {
            if (Schema::hasColumn('berita', 'kategori')) {
                $table->dropColumn('kategori');
            }
        });
    }
};
