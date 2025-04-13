@extends('mahasiswa.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('mahasiswa.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>

        <li class="breadcrumb-item active"><span data-coreui-i18n="pengajuan">Histori Pengajuan surat</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<div class="container">
    <h2 class="mb-4">Daftar Pengajuan Surat</h2>

    <table class="table table-responsive table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Surat</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th>Tanggal Persetujuan</th>
                <th>Catatan Kaprodi</th>
                <th>Catatan TU</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuans as $index => $pengajuan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pengajuan->surat->nama_jenis_surat }}</td>
                <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                <td>
                    <span class="badge 
                        {{ $pengajuan->status_pengajuan == 'Disetujui' ? 'bg-success' : 
                           ($pengajuan->status_pengajuan == 'Ditolak' ? 'bg-danger' : 
                           ($pengajuan->status_pengajuan == 'Done' ? 'bg-primary' : 'bg-warning')) }}">
                        {{ $pengajuan->status_pengajuan }}
                    </span>
                </td>
                <td>{{ $pengajuan->tanggal_persetujuan ?? '-' }}</td>
                <td>{{ $pengajuan->catatan_kaprodi ?? '-' }}</td>
                <td>{{ $pengajuan->catatan_tu ?? '-' }}</td>
                <td>
                    @if ($pengajuan->status_pengajuan == 'Done' && $pengajuan->file_surat)
                    <a href="{{ route('mahasiswa.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                        <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-download"></i></a>
                    @endif
                    @if ($pengajuan->status_pengajuan == 'Disetujui')
                        <a href="{{ route('mahasiswa.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    @endif
                    @if ($pengajuan->status_pengajuan == 'pending' || $pengajuan->status_pengajuan == 'Ditolak')
                        <a href="{{ route('mahasiswa.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <button class="btn btn-danger btn-sm delete-btn" data-id_pengajuan="{{ $pengajuan->id_pengajuan }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
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
            var pengajuanId = $(this).data('id_pengajuan');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pengajuan ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/mahasiswa/pengajuan/delete/' + pengajuanId,
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
