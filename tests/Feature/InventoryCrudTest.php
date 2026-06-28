<?php

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\RoleUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('halaman master inventaris bisa dibuka', function () {
    $this->withSession([
        'auth_id' => 1,
        'auth_role' => 'admin',
        'auth_name' => 'Admin Test',
    ]);

    $this->get('/barang')->assertOk();
    $this->get('/mahasiswa')->assertOk();
    $this->get('/admin')->assertOk();
    $this->get('/peminjaman')->assertOk();
    $this->get('/laporan')->assertOk();
});

test('data admin mahasiswa barang dan peminjaman bisa disimpan', function () {
    $this->withSession([
        'auth_id' => 1,
        'auth_role' => 'admin',
        'auth_name' => 'Admin Test',
    ]);

    $roleAdmin = RoleUser::firstOrCreate(['nama_role' => 'Admin']);
    $roleMahasiswa = RoleUser::firstOrCreate(['nama_role' => 'Mahasiswa']);
    $prodi = Prodi::firstOrCreate([
        'kode_prodi' => 'uji',
    ], [
        'nama_prodi' => 'Prodi Uji',
    ]);
    $kategori = KategoriBarang::firstOrCreate([
        'nama_kategori' => 'Kategori Uji',
    ]);

    $this->withoutMiddleware();

    $this->post('/admin', [
        'nama' => 'Admin Uji',
        'email' => 'admin.uji@test.local',
        'password' => 'password',
    ])->assertRedirect('/admin');

    $this->assertDatabaseHas('admins', [
        'nama' => 'Admin Uji',
        'email' => 'admin.uji@test.local',
        'role_user_id' => $roleAdmin->id,
    ]);

    $this->post('/mahasiswa', [
        'prodi_id' => $prodi->id,
        'nama' => 'Mahasiswa Uji',
        'nim' => '99001',
        'email' => 'mahasiswa.uji@test.local',
        'password' => 'password',
        'no_hp' => '081234567890',
        'alamat' => 'Alamat uji',
    ])->assertRedirect('/mahasiswa');

    $mahasiswa = Mahasiswa::where('nim', '99001')->firstOrFail();

    expect($mahasiswa->role_user_id)->toBe($roleMahasiswa->id);

    $this->post('/barang', [
        'kategori_barang_id' => $kategori->id,
        'kode_barang' => 'BRG-UJI',
        'nama_barang' => 'Barang Uji',
        'jumlah_barang' => 5,
    ])->assertRedirect('/barang');

    $barang = Barang::where('kode_barang', 'BRG-UJI')->firstOrFail();

    $this->post('/peminjaman', [
        'mahasiswa_id' => $mahasiswa->id,
        'barang_id' => $barang->id,
        'waktu_pinjam' => '2026-06-11 09:00:00',
        'waktu_kembali' => '2026-06-11 10:00:00',
        'jumlah_pinjam' => 2,
        'jumlah_kembali' => 1,
        'keterangan' => 'Uji peminjaman',
    ])->assertRedirect('/peminjaman');

    $this->assertDatabaseHas('peminjaman', [
        'mahasiswa_id' => $mahasiswa->id,
        'barang_id' => $barang->id,
        'jumlah_pinjam' => 2,
        'jumlah_kembali' => 1,
    ]);

    $this->withMiddleware();

    $this->get('/laporan?status=aktif')
        ->assertOk()
        ->assertSee('Mahasiswa Uji')
        ->assertSee('Barang Uji')
        ->assertSee('Aktif');
});

test('mahasiswa tidak bisa membuka data master', function () {
    $this->withSession([
        'auth_id' => 1,
        'auth_role' => 'mahasiswa',
        'auth_name' => 'Mahasiswa Test',
    ]);

    $this->get('/barang')->assertForbidden();
    $this->get('/mahasiswa')->assertForbidden();
    $this->get('/admin')->assertForbidden();
    $this->get('/peminjaman')->assertOk();
    $this->get('/laporan')->assertOk();
});
