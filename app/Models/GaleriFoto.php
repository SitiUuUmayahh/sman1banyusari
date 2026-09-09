<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class GaleriFoto extends Model
{
    protected $table = 'galeri_foto';

    public $timestamps = false;

    protected $fillable = [
        'album_id',
        'path_foto',
        'caption',
    ];

    protected static function booted(): void
    {
        static::deleting(function (self $foto): void {
            if ($foto->path_foto) {
                Storage::disk('public')->delete($foto->path_foto);
            }
        });
    }

    public function galeriAlbum(): BelongsTo
    {
        return $this->belongsTo(GaleriAlbum::class, 'album_id', 'id');
    }
}
