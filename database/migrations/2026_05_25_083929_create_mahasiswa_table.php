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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id')->constrained('prodis')->restrictOnDelete();
            $table->foreignId('role_user_id')->constrained('role_users')->restrictOnDelete();

            $table->string('nama', 50); // 255
            $table->string('nim', 10); // 255
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp', 15);
            $table->text('alamat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
