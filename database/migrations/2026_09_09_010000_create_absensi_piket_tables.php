<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_kelas');
            $table->enum('shift', ['pagi', 'siang']);
            $table->time('jam_cutoff_masuk');
            $table->time('jam_mulai_kbm');
        });

        Schema::create('guru', function (Blueprint $table): void {
            $table->id();
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('no_hp');
            $table->enum('role', ['guru_piket', 'admin_tu', 'kepsek']);
        });

        Schema::create('siswa', function (Blueprint $table): void {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('password');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->string('no_wa_ortu');
            $table->enum('status', ['aktif', 'lulus', 'pindah']);
        });

        Schema::create('jadwal_piket', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('guru_id')->nullable()->constrained('guru')->nullOnDelete();
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
        });

        Schema::create('qr_gerbang', function (Blueprint $table): void {
            $table->id();
            $table->string('lokasi');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->unsignedInteger('radius_meter');
            $table->string('token');
        });

        Schema::create('absensi_log', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->date('tanggal');
            $table->dateTime('jam_masuk');
            $table->enum('status_masuk', ['hadir', 'terlambat']);
            $table->dateTime('jam_pulang')->nullable();
            $table->decimal('latitude_scan', 10, 7);
            $table->decimal('longitude_scan', 10, 7);
            $table->foreignId('qr_gerbang_id')->constrained('qr_gerbang');
            $table->enum('input_by_type', ['siswa', 'guru']);
            $table->unsignedBigInteger('input_by_id')->nullable();
        });

        Schema::create('notifikasi_wa_log', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('absensi_log_id')->constrained('absensi_log')->cascadeOnDelete();
            $table->string('no_tujuan');
            $table->text('pesan');
            $table->enum('status_kirim', ['terkirim', 'gagal']);
            $table->dateTime('dikirim_at');
        });

        Schema::create('izin_sakit', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->enum('kategori', ['sakit', 'izin']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('keterangan');
            $table->string('file_lampiran')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('guru')->nullOnDelete();
            $table->text('catatan_verifikasi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('izin_sakit');
        Schema::dropIfExists('notifikasi_wa_log');
        Schema::dropIfExists('absensi_log');
        Schema::dropIfExists('qr_gerbang');
        Schema::dropIfExists('jadwal_piket');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('kelas');
    }
};
