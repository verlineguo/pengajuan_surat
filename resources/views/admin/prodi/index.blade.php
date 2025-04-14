@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="dashboard">Prodi</span>
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
    
    <h2 class="mb-4">Manajemen Prodi</h2>
    
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.prodi.create') }}" class="btn btn-primary mb-3">Tambah Prodi</a>
    </div>
        
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Prodi</th>
                <th>Nama Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prodis as $index => $prodi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $prodi->kode_prodi }}</td>
                    <td>{{ $prodi->nama_prodi }}</td>
                    <td>
                        <a href="{{ route('admin.prodi.edit', $prodi->kode_prodi) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm delete-btn" data-kode_prodi="{{ $prodi->kode_prodi }}">
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
            var kodeProdi = $(this).data('kode_prodi');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Prodi ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/prodi/delete/' + kodeProdi,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function () {
                            Swal.fire(
                                'Terhapus!',
                                'Prodi berhasil dihapus.',
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
