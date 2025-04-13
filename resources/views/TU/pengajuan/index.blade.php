@extends('TU.layouts.app') 

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container p-5">
    <h2 class="mb-4">Kelola Pengajuan Surat Mahasiswa</h2>
    <div class="d-flex justify-content-between align-items-center">
        <div class="mb-3">
            <select id="filter" class="form-control">
                <option value="">Semua status</option>
                <option value="pending">Pending</option>
                <option value="Disetujui" selected>Disetujui</option>
                <option value="Ditolak">Ditolak</option>
                <option value="Done">Done</option>
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
                <td>
                    @if ($pengajuan->status_pengajuan == 'Disetujui' && $pengajuan->file_surat)
                        <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-download"></i></a>
                    @endif

                    <a href="{{ route('tu.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info btn-sm"  style="background-color: #53BCE9">
                        <i class="fas fa-eye"></i>
                    </a>                
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

        var table = $('#pengajuanTable').DataTable();
        table.column(5).search('Disetujui').draw();


        $('#filter').on('change', function () {
            var selectedStatus = $(this).val();
            table.column(5).search(selectedStatus).draw();
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

