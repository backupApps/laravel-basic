<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matakuliah extends Model
{
    protected $table = 'matakuliahs';
    protected $guarded = [];

    public function mahasiswa_matakuliahs(): HasMany
    {
        return $this->hasMany(MahasiswaMatakuliah::class, 'matakuliah_id', 'id');
    }
}
