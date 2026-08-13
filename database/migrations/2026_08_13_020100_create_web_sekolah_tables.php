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
        Schema::create('admin_user', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['superadmin', 'editor']);
            $table->rememberToken();
        });

        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('gambar_cover');
            $table->foreignId('admin_id')->constrained('admin_user')->cascadeOnUpdate()->restrictOnDelete();
            $table->dateTime('published_at')->nullable();
        });

        Schema::create('galeri_album', function (Blueprint $table) {
            $table->id();
            $table->string('judul_album');
            $table->date('tanggal');
        });

        Schema::create('galeri_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained('galeri_album')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('path_foto');
            $table->string('caption')->nullable();
        });

        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nama_siswa')->nullable();
            $table->enum('tingkat', ['sekolah', 'kabupaten', 'provinsi', 'nasional', 'internasional']);
            $table->unsignedInteger('tahun');
            $table->string('gambar')->nullable();
            $table->foreignId('admin_id')->constrained('admin_user')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::create('halaman_statis', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul');
            $table->text('konten');
        });

        Schema::create('ppdb_info', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->text('jadwal');
            $table->text('syarat');
            $table->foreignId('admin_id')->constrained('admin_user')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_info');
        Schema::dropIfExists('halaman_statis');
        Schema::dropIfExists('prestasi');
        Schema::dropIfExists('galeri_foto');
        Schema::dropIfExists('galeri_album');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('admin_user');
    }
};
