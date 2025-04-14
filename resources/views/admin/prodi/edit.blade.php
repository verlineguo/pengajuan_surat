@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.prodi')}}" data-coreui-i18n="dashboard">Prodi</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="prodi">Edit</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Edit Prodi</strong></div>
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

            <form action="{{ route('admin.prodi.update', $prodi->kode_prodi) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label" for="kode_prodi">Kode Prodi</label>
                    <input class="form-control" id="kode_prodi" type="text" name="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama_prodi">Nama Prodi</label>
                    <input class="form-control" id="nama_prodi" type="text" name="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection