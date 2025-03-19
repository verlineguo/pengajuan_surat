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
                <th>Catatan TU</th>
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
                <td>{{ $pengajuan->catatan_tu ?? '-' }}</td>
                <td>
                    @if ($pengajuan->status_pengajuan == 'Disetujui' && $pengajuan->file_surat)
                        <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
                    @endif

                    <a href="{{ route('kaprodi.pengajuan.show', $pengajuan->id_pengajuan) }}" class="btn btn-info btn-sm text-white">Show</a>

                    @if ($pengajuan->status_pengajuan == 'pending')
                        <a href="{{ route('kaprodi.pengajuan.approve', $pengajuan->id_pengajuan) }}" class="btn btn-success text-white btn-sm">Setujui</a>
                        <a href="{{ route('kaprodi.pengajuan.reject', $pengajuan->id_pengajuan) }}" class="btn btn-danger text-white btn-sm">Tolak</a>
                    @endif

                    <form action="{{ route('kaprodi.pengajuan.destroy', $pengajuan->id_pengajuan) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark btn-sm text-white" onclick="return confirm('Yakin ingin menghapus pengajuan ini?');">Hapus</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
