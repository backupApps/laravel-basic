<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nama',
        'nim',
        'alamat'
    ];

    public function orangtua(): HasOne
    {
        return $this->hasOne(Orangtua::class, 'mahasiswa_id', 'id');
    }

    public function mahasiswa_matakuliahs(): HasMany
    {
        return $this->hasMany(MahasiswaMatakuliah::class, 'mahasiswa_id', 'id');
    }
}
