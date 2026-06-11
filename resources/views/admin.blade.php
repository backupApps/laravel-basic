@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Tabel Admin</h4>
                        <a href="{{ route('admin.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration + $admins->firstItem() - 1 }}</td>
                                    <td>{{ $admin->nama }}</td>
                                    <td>{{ $admin->roleUser->nama_role }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit', $admin) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form id="delete-admin{{ $admin->id }}"
                                            action="{{ route('admin.destroy', $admin) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteAdmin({{ $admin->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data admin.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $admins->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deleteAdmin(id) {
            if (!window.Swal) {
                if (confirm('Hapus data admin ini?')) {
                    document.getElementById('delete-admin' + id).submit();
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
                    document.getElementById('delete-admin' + id).submit();
                }
            });
        }
    </script>
@endpush
