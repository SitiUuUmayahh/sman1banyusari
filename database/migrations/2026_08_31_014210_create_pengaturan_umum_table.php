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
        Schema::create('pengaturan_umum', function (Blueprint $table) {
            $table->id();
            $table->string('alamat_sekolah')->nullable();
            $table->string('email_sekolah')->nullable();
            $table->string('telepon_sekolah')->nullable();
            $table->text('google_maps_embed_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->integer('jumlah_siswa_aktif')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_umum');
    }
};
