<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'konten',
        'tanggal',
        'admin_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'admin_id', 'id');
    }
}
