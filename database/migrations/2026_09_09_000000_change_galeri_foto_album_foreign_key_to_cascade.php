<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri_foto', function (Blueprint $table): void {
            $table->dropForeign('galeri_foto_album_id_foreign');
            $table->foreign('album_id')
                ->references('id')
                ->on('galeri_album')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('galeri_foto', function (Blueprint $table): void {
            $table->dropForeign('galeri_foto_album_id_foreign');
            $table->foreign('album_id')
                ->references('id')
                ->on('galeri_album')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }
};
