<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prodi', 8);
            $table->string('nama_prodi', 32);
            $table->timestamps();
        });

        DB::table('prodis')->insert([
            ['kode_prodi' => 'tind', 'nama_prodi' => 'Teknik Industri', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prodi' => 'tinf', 'nama_prodi' => 'Teknik Informatika', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prodi' => 'tsip', 'nama_prodi' => 'Teknik Sipil', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prodi' => 'bisdig', 'nama_prodi' => 'Bisnis Digital', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};
