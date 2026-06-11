<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
    ];

    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
