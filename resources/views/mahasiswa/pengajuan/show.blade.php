@extends('mahasiswa.layouts.app') 

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
                <tr class="bg-light">
                    <td><strong>Catatan Kaprodi</strong></td>
                    <td>{{ $pengajuan->catatan_kaprodi ? $pengajuan->catatan_kaprodi : '-' }}</td>
                </tr>

             

            </table>
            @if($pengajuan->file_surat && $pengajuan->status_pengajuan === 'Done')
                <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary" target="_blank">Download Surat</a>
            
            @endif


        </div>
    </div>

    <div class="card mt-4 shadow-lg p-3">
        <div class="card-body">
            <h5 class="card-title mb-3">Detail Surat</h5>
            <table class="table table-bordered table-striped">
                @if ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Mahasiswa Aktif')
                    <tr class="bg-light"><td><strong>Semester</strong></td><td>{{ $pengajuan->skma->semester }}</td></tr>
                    <tr><td><strong>Alamat Bandung</strong></td><td>{{ $pengajuan->skma->alamat_bandung }}</td></tr>
                    <tr class="bg-light"><td><strong>Keperluan</strong></td><td>{{ $pengajuan->skma->keperluan }}</td></tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Pengantar Tugas Mata Kuliah')
                    <tr class="bg-light"><td><strong>Surat Ditujukan Kepada</strong></td><td>{{ $pengajuan->sptmk->tujukan }}</td></tr>
                    <tr><td><strong>Mata Kuliah</strong></td><td>{{ $pengajuan->sptmk->mata_kuliah }}</td></tr>
                    <tr class="bg-light"><td><strong>Semester</strong></td><td>{{ $pengajuan->sptmk->semester }}</td></tr>
                    <tr><td><strong>Data Mahasiswa</strong></td><td>{{ $pengajuan->sptmk->data_mahasiswa }}</td></tr>
                    <tr class="bg-light"><td><strong>Tujuan</strong></td><td>{{ $pengajuan->sptmk->tujuan }}</td></tr>
                    <tr><td><strong>Topik</strong></td><td>{{ $pengajuan->sptmk->topik }}</td></tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Lulus')
                    <tr class="bg-light"><td><strong>Nama</strong></td><td>{{ $pengajuan->mahasiswa->name }}</td></tr>
                    <tr><td><strong>NRP</strong></td><td>{{ $pengajuan->mahasiswa->nomor_induk }}</td></tr>
                    <tr class="bg-light"><td><strong>Tanggal Kelulusan</strong></td>
                        <td>{{ $pengajuan->skl->tanggal_kelulusan ? $pengajuan->skl->tanggal_kelulusan->format('d-m-Y') : '-' }}</td>
                    </tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Laporan Hasil Studi')
                    <tr class="bg-light"><td><strong>Nama</strong></td><td>{{ $pengajuan->mahasiswa->name }}</td></tr>
                    <tr><td><strong>NRP</strong></td><td>{{ $pengajuan->mahasiswa->nomor_induk }}</td></tr>
                    <tr class="bg-light"><td><strong>Keperluan</strong></td><td>{{ $pengajuan->lhs->keperluan }}</td></tr>
                @endif
            </table>

            

           
        </div>
    </div>

    <a href="{{ route('mahasiswa.pengajuan') }}" class="btn btn-primary mt-4 mb-4">Kembali</a>
</div>

<script>
    function submitForm(status) {
        document.getElementById('status_pengajuan').value = status;
        document.getElementById('pengajuanForm').submit();
    }
</script>


@endsection
