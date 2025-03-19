@extends('admin.layouts.app')

@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Edit Mata Kuliah</strong></div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>                                
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.matakuliah.update', $matakuliah->kode_mk) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label" for="kode_mk">Kode Mata Kuliah</label>
                    <input class="form-control" id="kode_mk" type="text" name="kode_mk" value="{{ $matakuliah->kode_mk }}" readonly>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="nama_mk">Nama Mata Kuliah</label>
                    <input class="form-control" id="nama_mk" type="text" name="nama_mk" value="{{ old('nama_mk', $matakuliah->nama_mk) }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.matakuliah') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
