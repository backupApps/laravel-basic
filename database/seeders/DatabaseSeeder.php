<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use App\Models\Prodi;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = collect([
            'Admin',
            'Mahasiswa',
        ])->mapWithKeys(fn (string $namaRole) => [
            $namaRole => RoleUser::updateOrCreate(
                ['nama_role' => $namaRole],
                ['nama_role' => $namaRole],
            ),
        ]);

        $prodis = collect([
            ['kode_prodi' => 'tind', 'nama_prodi' => 'Teknik Industri'],
            ['kode_prodi' => 'tinf', 'nama_prodi' => 'Teknik Informatika'],
            ['kode_prodi' => 'tsip', 'nama_prodi' => 'Teknik Sipil'],
            ['kode_prodi' => 'bisdig', 'nama_prodi' => 'Bisnis Digital'],
            ['kode_prodi' => 'akunt', 'nama_prodi' => 'Akuntansi'],
            ['kode_prodi' => 'manj', 'nama_prodi' => 'Manajemen'],
        ])->mapWithKeys(fn (array $prodi) => [
            $prodi['kode_prodi'] => Prodi::updateOrCreate(
                ['kode_prodi' => $prodi['kode_prodi']],
                ['nama_prodi' => $prodi['nama_prodi']],
            ),
        ]);

        $kategoris = collect([
            'Infokus',
            'Cok Sambung',
            'Laptop',
            'Audio',
            'Kabel',
            'Kamera',
            'Jaringan',
            'Peralatan Kelas',
            'Peralatan Lab',
            'ATK',
        ])->mapWithKeys(fn (string $namaKategori) => [
            $namaKategori => KategoriBarang::updateOrCreate(
                ['nama_kategori' => $namaKategori],
                ['nama_kategori' => $namaKategori],
            ),
        ]);

        collect([
            ['nama' => 'Siti Rahmawati'],
            ['nama' => 'Dimas Pratama'],
            ['nama' => 'Rizky Maulana'],
            ['nama' => 'Anisa Putri Lestari'],
            ['nama' => 'Bagus Setiawan'],
            ['nama' => 'Maya Kartika'],
        ])->each(fn (array $admin) => Admin::updateOrCreate(
            ['nama' => $admin['nama']],
            ['role_user_id' => $roles['Admin']->id],
        ));

        $mahasiswa = collect([
            ['nim' => '2301001001', 'nama' => 'Ahmad Fauzan', 'prodi' => 'tinf', 'no_hp' => '081234560101', 'alamat' => 'Jl. Melati No. 12, Bandung'],
            ['nim' => '2301001002', 'nama' => 'Nur Aisyah', 'prodi' => 'tinf', 'no_hp' => '081234560102', 'alamat' => 'Jl. Anggrek No. 7, Cimahi'],
            ['nim' => '2301001003', 'nama' => 'Bima Arya Saputra', 'prodi' => 'tind', 'no_hp' => '081234560103', 'alamat' => 'Jl. Kenanga No. 18, Bandung'],
            ['nim' => '2301001004', 'nama' => 'Citra Dewi', 'prodi' => 'tsip', 'no_hp' => '081234560104', 'alamat' => 'Jl. Cempaka No. 4, Sumedang'],
            ['nim' => '2301001005', 'nama' => 'Eka Ramadhan', 'prodi' => 'bisdig', 'no_hp' => '081234560105', 'alamat' => 'Jl. Sukajadi No. 31, Bandung'],
            ['nim' => '2301001006', 'nama' => 'Fitri Handayani', 'prodi' => 'akunt', 'no_hp' => '081234560106', 'alamat' => 'Jl. Rajawali No. 22, Bandung'],
            ['nim' => '2301001007', 'nama' => 'Galih Prakoso', 'prodi' => 'manj', 'no_hp' => '081234560107', 'alamat' => 'Jl. Dipatiukur No. 15, Bandung'],
            ['nim' => '2301001008', 'nama' => 'Hana Kirana', 'prodi' => 'tinf', 'no_hp' => '081234560108', 'alamat' => 'Jl. Tubagus Ismail No. 9, Bandung'],
            ['nim' => '2301001009', 'nama' => 'Ilham Nugraha', 'prodi' => 'tind', 'no_hp' => '081234560109', 'alamat' => 'Jl. Gatot Subroto No. 45, Bandung'],
            ['nim' => '2301001010', 'nama' => 'Jihan Safitri', 'prodi' => 'tsip', 'no_hp' => '081234560110', 'alamat' => 'Jl. Asia Afrika No. 20, Bandung'],
            ['nim' => '2301001011', 'nama' => 'Kevin Aditya', 'prodi' => 'bisdig', 'no_hp' => '081234560111', 'alamat' => 'Jl. Buah Batu No. 88, Bandung'],
            ['nim' => '2301001012', 'nama' => 'Laras Permata', 'prodi' => 'akunt', 'no_hp' => '081234560112', 'alamat' => 'Jl. Setiabudi No. 27, Bandung'],
            ['nim' => '2301001013', 'nama' => 'Muhammad Farhan', 'prodi' => 'manj', 'no_hp' => '081234560113', 'alamat' => 'Jl. Antapani No. 11, Bandung'],
            ['nim' => '2301001014', 'nama' => 'Nabila Zahra', 'prodi' => 'tinf', 'no_hp' => '081234560114', 'alamat' => 'Jl. Arcamanik No. 5, Bandung'],
            ['nim' => '2301001015', 'nama' => 'Oscar Wijaya', 'prodi' => 'tind', 'no_hp' => '081234560115', 'alamat' => 'Jl. Kopo No. 103, Bandung'],
            ['nim' => '2301001016', 'nama' => 'Putri Amelia', 'prodi' => 'tsip', 'no_hp' => '081234560116', 'alamat' => 'Jl. Cibaduyut No. 42, Bandung'],
            ['nim' => '2301001017', 'nama' => 'Raka Mahendra', 'prodi' => 'bisdig', 'no_hp' => '081234560117', 'alamat' => 'Jl. Lengkong Besar No. 6, Bandung'],
            ['nim' => '2301001018', 'nama' => 'Salma Nurhaliza', 'prodi' => 'akunt', 'no_hp' => '081234560118', 'alamat' => 'Jl. Pahlawan No. 13, Bandung'],
            ['nim' => '2301001019', 'nama' => 'Tegar Prabowo', 'prodi' => 'manj', 'no_hp' => '081234560119', 'alamat' => 'Jl. Riau No. 73, Bandung'],
            ['nim' => '2301001020', 'nama' => 'Vina Oktaviani', 'prodi' => 'tinf', 'no_hp' => '081234560120', 'alamat' => 'Jl. Dago No. 56, Bandung'],
        ])->mapWithKeys(fn (array $item) => [
            $item['nim'] => Mahasiswa::updateOrCreate(
                ['nim' => $item['nim']],
                [
                    'prodi_id' => $prodis[$item['prodi']]->id,
                    'role_user_id' => $roles['Mahasiswa']->id,
                    'nama' => $item['nama'],
                    'no_hp' => $item['no_hp'],
                    'alamat' => $item['alamat'],
                ],
            ),
        ]);

        $barangs = collect([
            ['kode_barang' => 'INV-PRJ-001', 'nama_barang' => 'Proyektor Epson EB-X06', 'kategori' => 'Infokus', 'jumlah_barang' => 6],
            ['kode_barang' => 'INV-PRJ-002', 'nama_barang' => 'Proyektor BenQ MS550', 'kategori' => 'Infokus', 'jumlah_barang' => 4],
            ['kode_barang' => 'INV-CSB-001', 'nama_barang' => 'Stop Kontak Roll 10 Meter', 'kategori' => 'Cok Sambung', 'jumlah_barang' => 18],
            ['kode_barang' => 'INV-CSB-002', 'nama_barang' => 'Stop Kontak Roll 5 Meter', 'kategori' => 'Cok Sambung', 'jumlah_barang' => 24],
            ['kode_barang' => 'INV-LTP-001', 'nama_barang' => 'Laptop Lenovo ThinkPad E14', 'kategori' => 'Laptop', 'jumlah_barang' => 7],
            ['kode_barang' => 'INV-LTP-002', 'nama_barang' => 'Laptop ASUS Vivobook 14', 'kategori' => 'Laptop', 'jumlah_barang' => 5],
            ['kode_barang' => 'INV-AUD-001', 'nama_barang' => 'Speaker Portable JBL', 'kategori' => 'Audio', 'jumlah_barang' => 8],
            ['kode_barang' => 'INV-AUD-002', 'nama_barang' => 'Microphone Wireless Sennheiser', 'kategori' => 'Audio', 'jumlah_barang' => 6],
            ['kode_barang' => 'INV-KBL-001', 'nama_barang' => 'Kabel HDMI 5 Meter', 'kategori' => 'Kabel', 'jumlah_barang' => 30],
            ['kode_barang' => 'INV-KBL-002', 'nama_barang' => 'Kabel VGA 3 Meter', 'kategori' => 'Kabel', 'jumlah_barang' => 16],
            ['kode_barang' => 'INV-KBL-003', 'nama_barang' => 'Kabel LAN Cat6 10 Meter', 'kategori' => 'Kabel', 'jumlah_barang' => 22],
            ['kode_barang' => 'INV-CAM-001', 'nama_barang' => 'Kamera Canon EOS 200D', 'kategori' => 'Kamera', 'jumlah_barang' => 3],
            ['kode_barang' => 'INV-CAM-002', 'nama_barang' => 'Tripod Takara Rover 66', 'kategori' => 'Kamera', 'jumlah_barang' => 7],
            ['kode_barang' => 'INV-JRN-001', 'nama_barang' => 'Router MikroTik hAP ac2', 'kategori' => 'Jaringan', 'jumlah_barang' => 5],
            ['kode_barang' => 'INV-JRN-002', 'nama_barang' => 'Switch TP-Link 16 Port', 'kategori' => 'Jaringan', 'jumlah_barang' => 4],
            ['kode_barang' => 'INV-KLS-001', 'nama_barang' => 'Whiteboard Portable', 'kategori' => 'Peralatan Kelas', 'jumlah_barang' => 10],
            ['kode_barang' => 'INV-KLS-002', 'nama_barang' => 'Laser Pointer Logitech R400', 'kategori' => 'Peralatan Kelas', 'jumlah_barang' => 12],
            ['kode_barang' => 'INV-LAB-001', 'nama_barang' => 'Multimeter Digital Sanwa', 'kategori' => 'Peralatan Lab', 'jumlah_barang' => 9],
            ['kode_barang' => 'INV-LAB-002', 'nama_barang' => 'Toolkit Elektronika 32 in 1', 'kategori' => 'Peralatan Lab', 'jumlah_barang' => 14],
            ['kode_barang' => 'INV-ATK-001', 'nama_barang' => 'Spidol Whiteboard Hitam', 'kategori' => 'ATK', 'jumlah_barang' => 50],
            ['kode_barang' => 'INV-ATK-002', 'nama_barang' => 'Penghapus Whiteboard Magnetik', 'kategori' => 'ATK', 'jumlah_barang' => 20],
            ['kode_barang' => 'INV-ATK-003', 'nama_barang' => 'Map Plastik Arsip', 'kategori' => 'ATK', 'jumlah_barang' => 75],
        ])->mapWithKeys(fn (array $item) => [
            $item['kode_barang'] => Barang::updateOrCreate(
                ['kode_barang' => $item['kode_barang']],
                [
                    'kategori_barang_id' => $kategoris[$item['kategori']]->id,
                    'nama_barang' => $item['nama_barang'],
                    'jumlah_barang' => $item['jumlah_barang'],
                ],
            ),
        ]);

        collect([
            ['nim' => '2301001001', 'kode_barang' => 'INV-PRJ-001', 'waktu_pinjam' => '2026-05-28 08:00:00', 'waktu_kembali' => '2026-05-28 12:15:00', 'jumlah_pinjam' => 1, 'jumlah_kembali' => 1, 'keterangan' => 'Presentasi mata kuliah Pemrograman Web'],
            ['nim' => '2301001002', 'kode_barang' => 'INV-KBL-001', 'waktu_pinjam' => '2026-05-28 09:30:00', 'waktu_kembali' => '2026-05-28 11:00:00', 'jumlah_pinjam' => 2, 'jumlah_kembali' => 2, 'keterangan' => 'Kebutuhan seminar kelas'],
            ['nim' => '2301001003', 'kode_barang' => 'INV-LAB-001', 'waktu_pinjam' => '2026-05-29 10:00:00', 'waktu_kembali' => '2026-05-29 15:30:00', 'jumlah_pinjam' => 3, 'jumlah_kembali' => 3, 'keterangan' => 'Praktikum pengukuran dasar'],
            ['nim' => '2301001004', 'kode_barang' => 'INV-CSB-001', 'waktu_pinjam' => '2026-05-30 07:45:00', 'waktu_kembali' => '2026-05-30 13:10:00', 'jumlah_pinjam' => 4, 'jumlah_kembali' => 4, 'keterangan' => 'Kegiatan studio desain'],
            ['nim' => '2301001005', 'kode_barang' => 'INV-AUD-001', 'waktu_pinjam' => '2026-06-01 08:20:00', 'waktu_kembali' => '2026-06-01 16:00:00', 'jumlah_pinjam' => 1, 'jumlah_kembali' => 1, 'keterangan' => 'Talkshow bisnis digital'],
            ['nim' => '2301001006', 'kode_barang' => 'INV-CAM-001', 'waktu_pinjam' => '2026-06-01 13:00:00', 'waktu_kembali' => '2026-06-02 09:00:00', 'jumlah_pinjam' => 1, 'jumlah_kembali' => 1, 'keterangan' => 'Dokumentasi kegiatan himpunan'],
            ['nim' => '2301001007', 'kode_barang' => 'INV-KLS-002', 'waktu_pinjam' => '2026-06-02 07:30:00', 'waktu_kembali' => '2026-06-02 10:45:00', 'jumlah_pinjam' => 1, 'jumlah_kembali' => 1, 'keterangan' => 'Presentasi manajemen operasi'],
            ['nim' => '2301001008', 'kode_barang' => 'INV-LTP-001', 'waktu_pinjam' => '2026-06-03 09:00:00', 'waktu_kembali' => '2026-06-03 17:00:00', 'jumlah_pinjam' => 2, 'jumlah_kembali' => 2, 'keterangan' => 'Pelatihan coding'],
            ['nim' => '2301001009', 'kode_barang' => 'INV-JRN-001', 'waktu_pinjam' => '2026-06-04 08:00:00', 'waktu_kembali' => '2026-06-04 14:00:00', 'jumlah_pinjam' => 1, 'jumlah_kembali' => 1, 'keterangan' => 'Simulasi jaringan lab'],
            ['nim' => '2301001010', 'kode_barang' => 'INV-KBL-003', 'waktu_pinjam' => '2026-06-04 10:15:00', 'waktu_kembali' => '2026-06-04 12:30:00', 'jumlah_pinjam' => 5, 'jumlah_kembali' => 5, 'keterangan' => 'Instalasi sementara ruang C301'],
            ['nim' => '2301001011', 'kode_barang' => 'INV-PRJ-002', 'waktu_pinjam' => '2026-06-05 08:00:00', 'waktu_kembali' => null, 'jumlah_pinjam' => 1, 'jumlah_kembali' => 0, 'keterangan' => 'Dipakai untuk kelas tamu'],
            ['nim' => '2301001012', 'kode_barang' => 'INV-AUD-002', 'waktu_pinjam' => '2026-06-05 12:00:00', 'waktu_kembali' => null, 'jumlah_pinjam' => 2, 'jumlah_kembali' => 1, 'keterangan' => 'Satu mikrofon belum kembali'],
            ['nim' => '2301001013', 'kode_barang' => 'INV-CAM-002', 'waktu_pinjam' => '2026-06-06 09:30:00', 'waktu_kembali' => '2026-06-06 16:45:00', 'jumlah_pinjam' => 2, 'jumlah_kembali' => 2, 'keterangan' => 'Dokumentasi lomba kewirausahaan'],
            ['nim' => '2301001014', 'kode_barang' => 'INV-LTP-002', 'waktu_pinjam' => '2026-06-07 08:10:00', 'waktu_kembali' => null, 'jumlah_pinjam' => 1, 'jumlah_kembali' => 0, 'keterangan' => 'Pengerjaan proyek akhir'],
            ['nim' => '2301001015', 'kode_barang' => 'INV-LAB-002', 'waktu_pinjam' => '2026-06-07 11:00:00', 'waktu_kembali' => '2026-06-07 15:25:00', 'jumlah_pinjam' => 4, 'jumlah_kembali' => 4, 'keterangan' => 'Praktikum quality control'],
            ['nim' => '2301001016', 'kode_barang' => 'INV-KLS-001', 'waktu_pinjam' => '2026-06-08 07:50:00', 'waktu_kembali' => '2026-06-08 13:00:00', 'jumlah_pinjam' => 1, 'jumlah_kembali' => 1, 'keterangan' => 'Diskusi kelompok struktur bangunan'],
            ['nim' => '2301001017', 'kode_barang' => 'INV-CSB-002', 'waktu_pinjam' => '2026-06-09 09:15:00', 'waktu_kembali' => null, 'jumlah_pinjam' => 3, 'jumlah_kembali' => 2, 'keterangan' => 'Sisa satu unit masih di ruang seminar'],
            ['nim' => '2301001018', 'kode_barang' => 'INV-ATK-001', 'waktu_pinjam' => '2026-06-09 10:00:00', 'waktu_kembali' => '2026-06-09 12:00:00', 'jumlah_pinjam' => 6, 'jumlah_kembali' => 6, 'keterangan' => 'Kelas akuntansi biaya'],
            ['nim' => '2301001019', 'kode_barang' => 'INV-JRN-002', 'waktu_pinjam' => '2026-06-10 08:30:00', 'waktu_kembali' => null, 'jumlah_pinjam' => 1, 'jumlah_kembali' => 0, 'keterangan' => 'Konfigurasi jaringan event kampus'],
            ['nim' => '2301001020', 'kode_barang' => 'INV-ATK-003', 'waktu_pinjam' => '2026-06-10 13:00:00', 'waktu_kembali' => '2026-06-10 14:30:00', 'jumlah_pinjam' => 10, 'jumlah_kembali' => 10, 'keterangan' => 'Arsip berkas praktikum'],
        ])->each(fn (array $item) => Peminjaman::updateOrCreate(
            [
                'mahasiswa_id' => $mahasiswa[$item['nim']]->id,
                'barang_id' => $barangs[$item['kode_barang']]->id,
                'waktu_pinjam' => $item['waktu_pinjam'],
            ],
            [
                'waktu_kembali' => $item['waktu_kembali'],
                'jumlah_pinjam' => $item['jumlah_pinjam'],
                'jumlah_kembali' => $item['jumlah_kembali'],
                'keterangan' => $item['keterangan'],
            ],
        ));
    }
}
