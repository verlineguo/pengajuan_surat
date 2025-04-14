@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.mahasiswa')}}" data-coreui-i18n="dashboard">Surat</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="surat">Edit</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Edit Surat</strong></div>
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

            <form action="{{ route('admin.surat.update', $surat->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label" for="nama_jenis_surat">Nama Jenis Surat</label>
                    <input class="form-control" id="nama_jenis_surat" type="text" name="nama_jenis_surat" value="{{ old('nama_jenis_surat', $surat->nama_jenis_surat) }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection