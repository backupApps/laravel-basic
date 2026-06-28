@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Tabel Mahasiswa</h4>
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>Prodi</th>
                                <th>No HP</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mahasiswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $mahasiswa->firstItem() - 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nim }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->prodi->nama_prodi }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->roleUser->nama_role }}</td>
                                    <td>
                                        <a href="{{ route('mahasiswa.edit', $item) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form id="delete-mahasiswa{{ $item->id }}"
                                            action="{{ route('mahasiswa.destroy', $item) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteMahasiswa({{ $item->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data mahasiswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $mahasiswa->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deleteMahasiswa(id) {
            if (!window.Swal) {
                if (confirm('Hapus data mahasiswa ini?')) {
                    document.getElementById('delete-mahasiswa' + id).submit();
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
                    document.getElementById('delete-mahasiswa' + id).submit();
                }
            });
        }
    </script>
@endpush
