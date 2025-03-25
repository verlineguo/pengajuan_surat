@extends('kaprodi.layouts.app') {{-- Ganti layout admin --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Kelola Pengajuan Surat Mahasiswa</h2>

    <table class="table table-striped">
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
                    <span class="badge {{ $pengajuan->status_pengajuan == 'Disetujui' ? 'bg-success' : ($pengajuan->status_pengajuan == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $pengajuan->status_pengajuan }}
                    </span>
                </td>
                <td>{{ $pengajuan->tanggal_persetujuan ?? '-' }}</td>
                <td>{{ $pengajuan->catatan_kaprodi ?? '-' }}</td>
                <td>
                    @if ($pengajuan->status_pengajuan == 'Disetujui' && $pengajuan->file_surat)
                        <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
                    @endif

                    <a href="{{ route('kaprodi.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info"  style="background-color: #53BCE9">
                        <i class="fas fa-eye"></i>
                    </a>

                    @if ($pengajuan->status_pengajuan == 'pending')
                        <a href="{{ route('kaprodi.pengajuan.approve', $pengajuan->id_pengajuan) }}" class="btn" style="background-color: #47C97F; color: #000000">
                            <i class="fas fa-check-circle"></i>
                        </a>
                        <a href="{{ route('kaprodi.pengajuan.reject', $pengajuan->id_pengajuan) }}" class="btn btn-danger" style="background-color: #FA3F68">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    @endif

                    <form action="{{ route('kaprodi.pengajuan.destroy', $pengajuan->id_pengajuan) }}" method="POST" style="display:inline; background-color: #FBB65F;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark" onclick="return confirm('Yakin ingin menghapus pengajuan ini?');">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
