<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    protected $fillable = [
        'kategori_barang_id',
        'kode_barang',
        'nama_barang',
        'jumlah_barang',
    ];

    public function kategoriBarang(): BelongsTo
    {
        return $this->belongsTo(KategoriBarang::class);
    }
}
