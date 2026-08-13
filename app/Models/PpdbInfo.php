<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbInfo extends Model
{
    protected $table = 'ppdb_info';

    public $timestamps = false;

    protected $fillable = [
        'tahun_ajaran',
        'jadwal',
        'syarat',
        'admin_id',
    ];

    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'admin_id', 'id');
    }
}
