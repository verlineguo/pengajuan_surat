@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.surat')}}" data-coreui-i18n="dashboard">Surat</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="surat">Create</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container-lg px-4 p-5">
    <div class="card mb-4">
        <div class="card-header"><strong>Tambah Prodi</strong></div>
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

            <form action="{{ route('admin.prodi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="kode_prodi">Kode Prodi</label>
                    <input class="form-control" id="kode_prodi" type="text" name="kode_prodi" value="{{ old('kode_prodi') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama_prodi">Nama Prodi</label>
                    <input class="form-control" id="nama_prodi" type="text" name="nama_prodi" value="{{ old('nama_prodi') }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
