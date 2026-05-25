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
        Schema::create('kategori_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 32);
            $table->timestamps();
        });

        DB::table('kategori_barangs')->insert([
            ['nama_kategori' => 'Infokus', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Cok Sambung', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_barangs');
    }
};
