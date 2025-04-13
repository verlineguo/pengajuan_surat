@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="dashboard">User</span>
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
    <h2 class="mb-4">Manajemen User</h2>
    <div class="d-flex justify-content-between align-items-center">
        <div class="mb-3">
            <select  id="filter" class="form-control">
                <option value="">Semua role</option>
                @foreach ($roles as $role)
                    <option value = "{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary mb-3">Tambah User</a>

    </div>
    
    <table class="table table-striped" id="userTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Induk</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Program Studi</th>
                <th>Status</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->nomor_induk }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? 'Tidak Ada Role' }}</td>
                <td>{{ $user->prodi->nama_prodi ?? '-' }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    <a href="{{ route('admin.karyawan.edit', $user->nomor_induk) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->nomor_induk }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('.table').DataTable();
    });
</script>
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

        var table = $('#userTable').DataTable();

        $('#filter').on('change', function () {
            var selectedRole = $(this).val();
            table.column(4).search(selectedRole).draw();
        });
        $('.delete-btn').click(function () {
            var userId = $(this).data('nomor_induk');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "User ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/user/delete/' + userId,
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
