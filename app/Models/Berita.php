<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $table = 'berita';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar_cover',
        'kategori',
        'admin_id',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'admin_id', 'id');
    }
}
