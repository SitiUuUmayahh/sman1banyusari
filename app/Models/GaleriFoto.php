<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriFoto extends Model
{
    protected $table = 'galeri_foto';

    public $timestamps = false;

    protected $fillable = [
        'album_id',
        'path_foto',
        'caption',
    ];

    public function galeriAlbum(): BelongsTo
    {
        return $this->belongsTo(GaleriAlbum::class, 'album_id', 'id');
    }
}
