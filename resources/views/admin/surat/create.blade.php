@extends('admin.layouts.app')

@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Tambah Surat</strong></div>
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

            <form action="{{ route('admin.surat.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label" for="nama_jenis_surat">Nama Jenis Surat</label>
                    <input class="form-control" id="nama_jenis_surat" type="text" name="nama_jenis_surat" value="{{ old('nama_jenis_surat') }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
