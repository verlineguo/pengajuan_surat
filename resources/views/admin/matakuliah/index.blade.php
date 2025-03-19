@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Matakuliah</h2>

    <a href="{{ route('admin.matakuliah.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matakuliahs as $index => $matakuliah)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $matakuliah->kode_mk }}</td>
                <td>{{ $matakuliah->nama_mk }}</td>
                
                <td>
                    <a href="{{ route('admin.matakuliah.edit', $matakuliah->kode_mk) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                    <form action="{{ route('admin.matakuliah.delete', $matakuliah->kode_mk) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm text-white">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
