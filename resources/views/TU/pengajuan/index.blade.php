@extends('TU.layouts.app')
@section('header')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item text-white"><a href="{{ route('tu.dashboard') }}" data-coreui-i18n="home">Home</a>
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
                            <span
                                class="badge 
                        {{ $pengajuan->status_pengajuan == 'Disetujui'
                            ? 'bg-success'
                            : ($pengajuan->status_pengajuan == 'Ditolak'
                                ? 'bg-danger'
                                : ($pengajuan->status_pengajuan == 'Done' && $pengajuan->file_surat
                                    ? 'bg-primary'
                                    : 'bg-warning')) }}">
                                {{ $pengajuan->status_pengajuan }}
                            </span>
                        </td>
                        <td>{{ $pengajuan->tanggal_persetujuan ?? '-' }}</td>
                        <td>{{ $pengajuan->catatan_kaprodi ?? '-' }}</td>
                            <td class="text-nowrap">
                                <div class="d-flex align-items-center">
                                    @if ($pengajuan->status_pengajuan == 'Disetujui')
                                    <div class="dropdown me-1">
                                        <button class="btn btn-success btn-sm" type="button" id="uploadDropdown-{{ $pengajuan->id_pengajuan }}" data-coreui-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-file-upload"></i>
                                        </button>
                                        <div class="dropdown-menu p-3" style="min-width: 300px;" aria-labelledby="uploadDropdown-{{ $pengajuan->id_pengajuan }}">
                                            <form action="{{ route('tu.pengajuan.upload', $pengajuan->id_pengajuan) }}" method="POST" enctype="multipart/form-data" class="upload-form" id="uploadForm-{{ $pengajuan->id_pengajuan }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="file_surat-{{ $pengajuan->id_pengajuan }}" class="form-label">Pilih File</label>
                                                    <input type="file" name="file_surat" id="file_surat-{{ $pengajuan->id_pengajuan }}" class="form-control form-control-sm" required>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm" onclick="confirmUpload('{{ $pengajuan->id_pengajuan }}')">
                                                    <i class="fas fa-upload"></i> Upload
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if ($pengajuan->status_pengajuan == 'Done' && $pengajuan->file_surat)
                                        <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary me-1 btn-sm" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                            
                                    <a href="{{ route('tu.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info btn-sm view-detail" style="background-color: #53BCE9">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
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
        $(document).ready(function() {
            // Tampilkan loading saat halaman dimuat
            Swal.fire({
                title: 'Mengirim...',
                html: 'Mohon tunggu, sedang diproses.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Inisialisasi DataTable dengan callback saat selesai
            var table = $('#pengajuanTable').DataTable({
                "initComplete": function() {
                    // Sembunyikan loading setelah DataTable dimuat
                    Swal.close();
                }
            });
            
            // Set filter default ke "Disetujui"
            table.column(5).search('Disetujui').draw();

            // Event handler untuk filter
            $('#filter').on('change', function() {
                Swal.fire({
                    title: 'Mengirim...',
                    html: 'Mohon tunggu, sedang diproses.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                var selectedStatus = $(this).val();
                table.column(5).search(selectedStatus).draw();
                setTimeout(function() {
                    Swal.close();
                }, 300);
            });
            
            // Event handler untuk tombol view detail
            $('.view-detail').on('click', function(e) {
                Swal.fire({
                    title: 'Mengirim...',
                    html: 'Mohon tunggu, sedang diproses.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });
        
        function confirmUpload(id) {
    Swal.fire({
        title: 'Konfirmasi Upload',
        text: "Apakah Anda yakin ingin mengunggah surat ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Upload!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
                title: 'Mengirim...',
                html: 'Mohon tunggu, sedang diproses.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form dengan AJAX
            var formData = new FormData($('#uploadForm-'+id)[0]);
            $.ajax({
                url: $('#uploadForm-'+id).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'File berhasil diupload',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat upload file',
                        icon: 'error'
                    });
                }
            });
        }
    });
}
   </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection