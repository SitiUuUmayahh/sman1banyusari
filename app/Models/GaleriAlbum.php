<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class GaleriAlbum extends Model
{
    protected $table = 'galeri_album';

    public $timestamps = false;

    protected $fillable = [
        'judul_album',
        'tanggal',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (self $album): void {
            $album->galeriFotos()
                ->pluck('path_foto')
                ->each(fn (string $path): bool => Storage::disk('public')->delete($path));
        });
    }

    public function galeriFotos(): HasMany
    {
        return $this->hasMany(GaleriFoto::class, 'album_id', 'id');
    }
}
