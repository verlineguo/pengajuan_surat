@extends('TU.layouts.app') 

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Pengajuan Surat</h2>

    <div class="card shadow-lg p-3">
        <div class="card-body">
            <h5 class="card-title mb-3">Informasi Pengajuan</h5>
            <table class="table table-bordered table-striped">
                <tr><td><strong>Nama Surat</strong></td><td>{{ $pengajuan->surat->nama_jenis_surat }}</td></tr>
                <tr class="bg-light">
                    <td><strong>Status</strong></td>
                    <td>
                        @if($pengajuan->status_pengajuan === 'Disetujui')
                            <span class="badge bg-success">{{ $pengajuan->status_pengajuan }}</span>
                        @elseif($pengajuan->status_pengajuan === 'Ditolak')
                            <span class="badge bg-danger">{{ $pengajuan->status_pengajuan }}</span>
                        @elseif($pengajuan->status_pengajuan === 'pending')
                            <span class="badge bg-warning text-dark">{{ $pengajuan->status_pengajuan }}</span>
                        @elseif($pengajuan->status_pengajuan === 'Done')
                            <span class="badge bg-primary">{{ $pengajuan->status_pengajuan }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $pengajuan->status_pengajuan }}</span>
                        @endif
                    </td>
                </tr>
                <tr><td><strong>Tanggal Pengajuan</strong></td><td>{{ $pengajuan->tanggal_pengajuan->format('d-m-Y H:i') }}</td></tr>
                @if($pengajuan->tanggal_persetujuan)
                <tr class="bg-light"><td><strong>Tanggal Persetujuan</strong></td><td>{{ $pengajuan->tanggal_persetujuan->format('d-m-Y H:i') }}</td></tr>
                @endif

                @if($pengajuan->status_pengajuan === 'Disetujui' || $pengajuan->status_pengajuan === 'Ditolak')
                    <tr class="bg-light">
                        <td><strong>Catatan Kaprodi</strong></td>
                        <td>{{ $pengajuan->catatan_kaprodi ? $pengajuan->catatan_kaprodi : '-' }}</td>
                    </tr>
                @endif
                @if($pengajuan->catatan_tu)
                <tr>
                    <td><strong>Catatan TU</strong></td>
                    <td>{{ $pengajuan->catatan_tu }}</td>
                </tr>
                @endif
            </table>

         
            @if($pengajuan->status_pengajuan === 'Disetujui' || $pengajuan->status_pengajuan === 'Done')
                @if($pengajuan->file_surat)
                    <!-- Tombol Download dan Ulang Upload -->
                    <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary" target="_blank">Download Surat</a>
                    <button class="btn btn-warning text-white" onclick="toggleUploadForm()">Ulang Upload</button>

                    <!-- Form Ulang Upload -->
                    <form id="uploadForm" action="{{ route('tu.pengajuan.upload', $pengajuan->id_pengajuan) }}" method="POST" enctype="multipart/form-data" class="mt-3" style="display: none;">
                        @csrf
                        <div class="mb-2">
                            <label for="catatan_tu" class="form-label">Catatan TU (Opsional)</label>
                            <textarea name="catatan_tu" id="catatan_tu" class="form-control"></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="file_surat" class="form-label">Upload Surat</label>
                            <input type="file" name="file_surat" id="file_surat" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success text-white mt-3">Upload Surat</button>
                    </form>
                @else
                    <!-- Form Upload Surat Jika Belum Ada File -->
                    <form action="{{ route('tu.pengajuan.upload', $pengajuan->id_pengajuan) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="mb-2">
                            <label for="catatan_tu" class="form-label">Catatan TU (Opsional)</label>
                            <textarea name="catatan_tu" id="catatan_tu" class="form-control"></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="file_surat" class="form-label">Upload Surat</label>
                            <input type="file" name="file_surat" id="file_surat" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success text-white mt-3">Upload Surat</button>
                    </form>
                @endif
            @endif
                

        </div>
    </div>

    <div class="card mt-4 shadow-lg p-3">
        <div class="card-body">
            <h5 class="card-title mb-3">Detail Surat</h5>
            <table class="table table-bordered table-striped">
                @if ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Mahasiswa Aktif')
                    <tr class="bg-light"><td><strong>Semester</strong></td><td>{{ $pengajuan->detailSurat->semester }}</td></tr>
                    <tr><td><strong>Alamat Bandung</strong></td><td>{{ $pengajuan->detailSurat->alamat_bandung }}</td></tr>
                    <tr class="bg-light"><td><strong>Keperluan</strong></td><td>{{ $pengajuan->detailSurat->keperluan }}</td></tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Pengantar Tugas Mata Kuliah')
                    <tr class="bg-light"><td><strong>Surat Ditujukan Kepada</strong></td><td>{{ $pengajuan->detailSurat->tujukan }}</td></tr>
                    <tr><td><strong>Mata Kuliah</strong></td><td>{{ $pengajuan->detailSurat->mata_kuliah }}</td></tr>
                    <tr class="bg-light"><td><strong>Semester</strong></td><td>{{ $pengajuan->detailSurat->semester }}</td></tr>
                    <tr><td><strong>Data Mahasiswa</strong></td><td>{{ $pengajuan->detailSurat->data_mahasiswa }}</td></tr>
                    <tr class="bg-light"><td><strong>Tujuan</strong></td><td>{{ $pengajuan->detailSurat->tujuan }}</td></tr>
                    <tr><td><strong>Topik</strong></td><td>{{ $pengajuan->detailSurat->topik }}</td></tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Lulus')
                    <tr class="bg-light"><td><strong>Nama</strong></td><td>{{ $pengajuan->mahasiswa->name }}</td></tr>
                    <tr><td><strong>NRP</strong></td><td>{{ $pengajuan->mahasiswa->nomor_induk }}</td></tr>
                    <tr class="bg-light"><td><strong>Tanggal Kelulusan</strong></td>
                        <td>{{ $pengajuan->detailSurat->tanggal_kelulusan ? $pengajuan->detailSurat->tanggal_kelulusan->format('d-m-Y') : '-' }}</td>
                    </tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Laporan Hasil Studi')
                    <tr class="bg-light"><td><strong>Nama</strong></td><td>{{ $pengajuan->mahasiswa->name }}</td></tr>
                    <tr><td><strong>NRP</strong></td><td>{{ $pengajuan->mahasiswa->nomor_induk }}</td></tr>
                    <tr class="bg-light"><td><strong>Keperluan</strong></td><td>{{ $pengajuan->detailSurat->keperluan }}</td></tr>
                @endif
            </table>
        </div>
    </div>

    <a href="{{ route('kaprodi.pengajuan') }}" class="btn btn-primary mt-4">Kembali</a>
</div>

<script>
    function submitForm(status) {
        document.getElementById('status_pengajuan').value = status;
        document.getElementById('pengajuanForm').submit();
    }
    
</script>
<script>
    function toggleUploadForm() {
        const form = document.getElementById('uploadForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>

<script>
    function confirmUlangUpload() {
        Swal.fire({
            title: 'Ulang Upload?',
            text: "Anda akan mengganti file surat yang sudah ada.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ulang Upload!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('uploadForm');
                form.style.display = 'block'; // Tampilkan form ulang upload
            }
        });
    }
</script>

<script>
    function confirmUlangUpload() {
        Swal.fire({
            title: 'Ulang Upload?',
            text: "Anda akan mengganti file surat yang sudah ada.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ulang Upload!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('uploadForm');
                form.style.display = 'block'; // Tampilkan form ulang upload
            }
        });
    }
</script>

@endsection
