@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.karyawan')}}" data-coreui-i18n="dashboard">User</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="user">Edit</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Edit User</strong></div>
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
            
            <form action="{{ route('admin.karyawan.update', $user->nomor_induk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 text-center">
                    <label class="form-label">Foto Profil</label>
                    <br>
                    @if ($user->profile)
                        <img src="{{ asset('storage/' . $user->profile) }}" 
                            alt="Profile Picture" class="img-thumbnail" width="150px" height="150px">
                    @else
                        <i class="fas fa-user-circle" style="font-size: 150px; color: #ccc;"></i>
                    @endif
                    <br>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nomor_induk">Nomor Induk</label>
                    <input class="form-control" id="nomor_induk" type="text" name="nomor_induk" value="{{ old('nomor_induk', $user->nomor_induk) }}" readonly>
                </div>

                
                
                <div class="mb-3">
                    <label class="form-label" for="name">Nama</label>
                    <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="kode_prodi">Prodi</label>
                    <select class="form-select" id="kode_prodi" name="kode_prodi" required>
                        <option value="">Pilih Prodi</option>
                        @foreach($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $user->kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="mb-3">
                    <label class="form-label" for="role_id">Role</label>
                    <select class="form-select" id="role_id" name="role_id" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="password">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input class="form-control" id="password" type="password" name="password">
                </div>
                
                
                <div class="mb-3">
                    <label class="form-label" for="phone">Telepon</label>
                    <input class="form-control" id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="address">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
