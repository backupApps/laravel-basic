@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Tabel Barang</h4>
                        <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangs as $barang)
                                <tr>
                                    <td>{{ $loop->iteration + $barangs->firstItem() - 1 }}</td>
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->kategoriBarang->nama_kategori }}</td>
                                    <td>{{ $barang->jumlah_barang }}</td>
                                    <td>
                                        <a href="{{ route('barang.edit', $barang) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form id="delete{{ $barang->id }}"
                                            action="{{ route('barang.destroy', $barang) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteData({{ $barang->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $barangs->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

@push('scripts')
<script>
    function deleteData(id) {
        if (!window.Swal) {
            if (confirm('Hapus data barang ini?')) {
                document.getElementById('delete' + id).submit();
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
                document.getElementById('delete' + id).submit();
            }
        });
    }
</script>
@endpush
