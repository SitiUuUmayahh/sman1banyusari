<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function galeriFotos(): HasMany
    {
        return $this->hasMany(GaleriFoto::class, 'album_id', 'id');
    }
}
