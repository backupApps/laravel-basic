<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'prodi_id',
        'role_user_id',
        'nama',
        'nim',
        'no_hp',
        'alamat',
    ];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }

    public function roleUser(): BelongsTo
    {
        return $this->belongsTo(RoleUser::class);
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }
}
