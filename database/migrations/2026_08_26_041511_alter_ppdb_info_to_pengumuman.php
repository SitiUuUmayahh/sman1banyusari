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
        if (Schema::hasTable('ppdb_info') && ! Schema::hasTable('pengumuman')) {
            Schema::rename('ppdb_info', 'pengumuman');
        }

        if (Schema::hasTable('pengumuman')) {
            Schema::table('pengumuman', function (Blueprint $table) {
                if (Schema::hasColumn('pengumuman', 'tahun_ajaran')) {
                    $table->dropColumn(['tahun_ajaran', 'jadwal', 'syarat']);
                }
            });

            Schema::table('pengumuman', function (Blueprint $table) {
                if (! Schema::hasColumn('pengumuman', 'judul')) {
                    $table->string('judul')->after('id');
                }

                if (! Schema::hasColumn('pengumuman', 'konten')) {
                    $table->text('konten')->after('judul');
                }

                if (! Schema::hasColumn('pengumuman', 'tanggal')) {
                    $table->date('tanggal')->nullable()->default(now())->after('konten');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pengumuman')) {
            Schema::table('pengumuman', function (Blueprint $table) {
                if (Schema::hasColumn('pengumuman', 'judul')) {
                    $table->dropColumn(['judul', 'konten', 'tanggal']);
                }
            });

            Schema::table('pengumuman', function (Blueprint $table) {
                if (! Schema::hasColumn('pengumuman', 'tahun_ajaran')) {
                    $table->string('tahun_ajaran')->after('id');
                    $table->text('jadwal')->after('tahun_ajaran');
                    $table->text('syarat')->after('jadwal');
                }
            });

            Schema::rename('pengumuman', 'ppdb_info');
        }
    }
};
