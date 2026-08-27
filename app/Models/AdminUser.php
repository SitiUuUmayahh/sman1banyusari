<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method bool hasRole(string|int|array|\Spatie\Permission\Models\Role|\Illuminate\Support\Collection|\BackedEnum $roles, ?string $guard = null)
 */
class AdminUser extends Authenticatable implements FilamentUser, HasName
{
    use HasRoles;

    protected $table = 'admin_user';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guard_name = 'web';

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->nama;
    }

    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class, 'admin_id', 'id');
    }

    public function prestasis(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'admin_id', 'id');
    }

    public function pengumumans(): HasMany
    {
        return $this->hasMany(Pengumuman::class, 'admin_id', 'id');
    }
}
