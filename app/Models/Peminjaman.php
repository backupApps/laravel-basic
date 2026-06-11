<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'mahasiswa_id',
        'barang_id',
        'waktu_pinjam',
        'waktu_kembali',
        'jumlah_pinjam',
        'jumlah_kembali',
        'keterangan',
    ];

    protected $casts = [
        'waktu_pinjam' => 'datetime',
        'waktu_kembali' => 'datetime',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
