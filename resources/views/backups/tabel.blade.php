@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Default Datatable</h4>
                    <p class="card-title-desc">DataTables has most features enabled by
                        default, so all you need to do to use it with your own tables is to call
                        the construction function: <code>$().DataTable();</code>.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Alamat</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $mhs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->alamat }}</td>
                                    <td>{{ $mhs->orangtua?->nama_ayah }}</td>
                                    <td>{{ $mhs->orangtua?->nama_ibu }}</td>
                                    <td>
                                        {{-- edit --}}
                                        <a href="{{ route('form.edit', $mhs->id) }}" class="btn btn-sm btn-info">
                                            <i class="mdi mdi-pen"></i>
                                            Edit
                                        </a>

                                        {{-- hapus --}}
                                        <button class="btn btn-sm btn-danger" onclick="deleteData({{ $mhs->id }})">
                                            <i class="mdi mdi-trash-can"></i>
                                            Hapus
                                        </button>
                                        <form action="{{ route('form.delete', $mhs->id) }}" method="post" id="delete{{ $mhs->id }}"
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
