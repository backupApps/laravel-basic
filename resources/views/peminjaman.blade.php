@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Tabel Peminjaman</h4>
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Mahasiswa</th>
                                <th>Barang</th>
                                <th>Waktu Pinjam</th>
                                <th>Waktu Kembali</th>
                                <th>Pinjam</th>
                                <th>Kembali</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjaman as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $peminjaman->firstItem() - 1 }}</td>
                                    <td>{{ $item->mahasiswa->nama }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->waktu_pinjam->translatedFormat('d F Y H:i') }}</td>
                                    <td>{{ $item->waktu_kembali?->translatedFormat('d F Y H:i') ?? '-' }}</td>
                                    <td>{{ $item->jumlah_pinjam }}</td>
                                    <td>{{ $item->jumlah_kembali }}</td>
                                    <td>
                                        <a href="{{ route('peminjaman.edit', $item) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form id="delete-peminjaman{{ $item->id }}"
                                            action="{{ route('peminjaman.destroy', $item) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deletePeminjaman({{ $item->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data peminjaman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $peminjaman->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deletePeminjaman(id) {
            if (!window.Swal) {
                if (confirm('Hapus data peminjaman ini?')) {
                    document.getElementById('delete-peminjaman' + id).submit();
                }

                return;
            }

            Swal.fire({
                title: "Anda Yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById('delete-peminjaman' + id).submit();
                }
            });
        }
    </script>
@endpush
