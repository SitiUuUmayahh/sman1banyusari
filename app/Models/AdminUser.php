<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdminUser extends Model
{
    protected $table = 'admin_user';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class, 'admin_id', 'id');
    }

    public function prestasis(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'admin_id', 'id');
    }

    public function ppdbInfos(): HasMany
    {
        return $this->hasMany(PpdbInfo::class, 'admin_id', 'id');
    }
}
