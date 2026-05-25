<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaMatakuliah extends Model
{
    protected $table = 'mahasiswa_matakuliahs';
    protected $guarded = [];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }
    public function matakuliahs(): BelongsTo
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id', 'id');
    }
}
