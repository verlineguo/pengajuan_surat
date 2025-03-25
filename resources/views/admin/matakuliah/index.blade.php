@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="dashboard">Mata Kuliah</span>
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<div class="container">
    <h2 class="mb-4">Manajemen Matakuliah</h2>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.matakuliah.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matakuliahs as $index => $matakuliah)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $matakuliah->kode_mk }}</td>
                <td>{{ $matakuliah->nama_mk }}</td>
                
                <td>
                    <a href="{{ route('admin.matakuliah.edit', $matakuliah->kode_mk) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $matakuliah->kode_mk }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
@endif
<script>
    $(document).ready(function () {
        
        $('.table').DataTable();

        $('.delete-btn').click(function () {
            var mkid = $(this).data('kode_mk');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Matakuliah ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/matakuliah/delete/' + mkid,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function () {
                            Swal.fire(
                                'Terhapus!',
                                'Surat berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
