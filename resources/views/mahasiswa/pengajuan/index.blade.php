@extends('mahasiswa.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pengajuan Surat</h2>

    <table class="table table-striped">
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
                    <span class="badge {{ $pengajuan->status_pengajuan == 'Disetujui' ? 'bg-success' : ($pengajuan->status_pengajuan == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $pengajuan->status_pengajuan }}
                    </span>
                </td>
                <td>{{ $pengajuan->tanggal_persetujuan ?? '-' }}</td>
                <td>{{ $pengajuan->catatan_kaprodi ?? '-' }}</td>
                <td>{{ $pengajuan->catatan_tu ?? '-' }}</td>
                <td>
                    @if ($pengajuan->status_pengajuan == 'Disetujui' && $pengajuan->file_surat)
                        <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
                    @else
                        <span class="text-muted"></span>
                    @endif                
                    <a href="{{ route('mahasiswa.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info btn-sm text-white">Show</a>
                    <a href="{{ route('mahasiswa.pengajuan.edit', $pengajuan->id_pengajuan) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                    <form action="{{ route('mahasiswa.pengajuan.destroy', $pengajuan->id_pengajuan) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm('Yakin ingin menghapus pengajuan ini?');">Delete</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
