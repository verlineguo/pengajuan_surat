@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen User</h2>

    <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Tambah User</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Induk</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->nomor_induk }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? 'Tidak Ada Role' }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
