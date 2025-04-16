@extends('kaprodi.layouts.app') {{-- Ganti layout admin --}}
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('kaprodi.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
   
        <li class="breadcrumb-item active"><span data-coreui-i18n="user">Pengajuan</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container p-5">
    <h2 class="mb-4">Kelola Pengajuan Surat Mahasiswa</h2>
    <div class="d-flex justify-content-between align-items-center">
        <div class="mb-3">
            <select id="filter" class="form-control">
                <option value="">Semua status</option>
                <option value="pending" selected>Pending</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Ditolak">Ditolak</option>
            </select>
        </div>
    </div>
    <table class="table table-striped" id="pengajuanTable">
        <thead>
            <tr>
                <th>No</th>
                <th>NRP</th>
                <th>Nama Mahasiswa</th>
                <th>Jenis Surat</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th>Tanggal Persetujuan</th>
                <th>Catatan Kaprodi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuans as $index => $pengajuan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pengajuan->mahasiswa->nomor_induk }}</td> 
                <td>{{ $pengajuan->mahasiswa->name }}</td> 
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
                <td class="text-nowrap">
                    @if ($pengajuan->status_pengajuan == 'Disetujui' && $pengajuan->file_surat)
                        <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
                    @endif

                    <a href="{{ route('kaprodi.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info"  style="background-color: #53BCE9">
                        <i class="fas fa-eye"></i>
                    </a>

                    @if ($pengajuan->status_pengajuan == 'pending')
                        <button type="button" class="btn btn-success approve-btn" data-id_pengajuan="{{ $pengajuan->id_pengajuan }}">
                            <i class="fas fa-check-circle"></i>
                        </button>
                        
                        <button type="button" class="btn btn-danger reject-btn" data-id_pengajuan="{{ $pengajuan->id_pengajuan }}">
                            <i class="fas fa-times-circle"></i>
                        </button>
                
                    @endif

                
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('.table').DataTable();

        var table = $('#pengajuanTable').DataTable();
        table.column(5).search('pending').draw();


        $('#filter').on('change', function () {
            var selectedStatus = $(this).val();
            table.column(5).search(selectedStatus).draw();
        });

        $('.approve-btn').click(function () {
            var pengajuanId = $(this).data('id_pengajuan');

            Swal.fire({
                title: 'Setujui Pengajuan?',
                text: "Anda akan menyetujui pengajuan ini.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mengirim...',
                        html: 'Mohon tunggu, sedang diproses.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    $.post("{{ url('kaprodi/pengajuan') }}/" + pengajuanId + "/approve", {
                        _token: '{{ csrf_token() }}'
                    }, function (data) {
                        Swal.fire(
                            'Berhasil!',
                            'Pengajuan telah disetujui.',
                            'success'
                        ).then(() => location.reload());
                    }).fail(function () {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menyetujui.',
                            'error'
                        );
                    });
                }
            });
        });

        $('.reject-btn').click(function () {
            var pengajuanId = $(this).data('id_pengajuan');

            Swal.fire({
                title: 'Tolak Pengajuan?',
                text: "Anda akan menolak pengajuan ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('kaprodi/pengajuan') }}/" + pengajuanId + "/reject", {
                        _token: '{{ csrf_token() }}'
                    }, function (data) {
                        Swal.fire(
                            'Ditolak!',
                            'Pengajuan telah ditolak.',
                            'success'
                        ).then(() => location.reload());
                    }).fail(function () {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menolak.',
                            'error'
                        );
                    });
                }
            });
        });
    
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

@endsection
