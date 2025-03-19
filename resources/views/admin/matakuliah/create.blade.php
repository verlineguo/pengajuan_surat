@extends('admin.layouts.app')

@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Form Tambah Mata Kuliah</strong></div>
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

            <form action="{{ route('admin.matakuliah.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label" for="kode_mk">Kode Mata Kuliah</label>
                    <input class="form-control" id="kode_mk" type="text" name="kode_mk" value="{{ old('kode_mk') }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="nama_mk">Nama Mata Kuliah</label>
                    <input class="form-control" id="nama_mk" type="text" name="nama_mk" value="{{ old('nama_mk') }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
