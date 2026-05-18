@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Tabel Matakuliah</h4>
                        <a href="{{ route('matakuliah.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Matakuliah</th>
                                <th>Nama Matakuliah</th>
                                <th>SKS</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_matakuliah }}</td>
                                    <td>{{ $item->nama_matakuliah }}</td>
                                    <td>{{ $item->sks }}</td>
                                    <td>
                                        {{-- edit --}}
                                        <a href="{{ route('matakuliah.edit', $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="mdi mdi-pen"></i>
                                            Edit
                                        </a>

                                        {{-- hapus --}}
                                        <button class="btn btn-sm btn-danger" onclick="deleteData({{ $item->id }})">
                                            <i class="mdi mdi-trash-can"></i>
                                            Hapus
                                        </button>
                                        <form action="{{ route('matakuliah.delete', $item->id) }}" method="post" id="delete{{ $item->id }}"
                                            class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

<script>
    function deleteData(id) {
        Swal.fire({
            title: "Anda Yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning"
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('delete' + id).submit();
            }
        });
    }
</script>
