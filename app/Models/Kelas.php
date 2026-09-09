<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $table = 'kelas';

    public $timestamps = false;

    protected $fillable = [
        'nama_kelas',
        'shift',
        'jam_cutoff_masuk',
        'jam_mulai_kbm',
    ];

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}
