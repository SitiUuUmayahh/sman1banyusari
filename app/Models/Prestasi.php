<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'nama_siswa',
        'tingkat',
        'tahun',
        'gambar',
        'admin_id',
    ];

    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
        ];
    }

    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'admin_id', 'id');
    }
}
