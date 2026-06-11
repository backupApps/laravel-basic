<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->restrictOnDelete();
            $table->foreignId('barang_id')->constrained('barangs')->restrictOnDelete();
            $table->dateTime('waktu_pinjam');
            $table->dateTime('waktu_kembali')->nullable();
            $table->unsignedInteger('jumlah_pinjam');
            $table->unsignedInteger('jumlah_kembali')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
