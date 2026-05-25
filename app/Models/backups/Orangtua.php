<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orangtua extends Model
{
    protected $table = 'orangtua';

    protected $fillable = [
        'mahasiswa_id',
        'nama_ayah',
        'nama_ibu',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahahsiswa_id', 'id');
    }
}
