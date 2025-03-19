@extends('admin.layouts.app')

@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Daftar Surat</strong></div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <a href="{{ route('admin.surat.create') }}" class="btn btn-primary mb-3">Tambah Surat</a>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Jenis Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surats as $surat)
                        <tr>
                            <td>{{ $surat->id }}</td>
                            <td>{{ $surat->nama_jenis_surat }}</td>
                            <td>
                                <a href="{{ route('admin.surat.edit', $surat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.surat.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
