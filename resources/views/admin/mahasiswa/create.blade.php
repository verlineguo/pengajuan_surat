@extends('admin.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.mahasiswa')}}" data-coreui-i18n="dashboard">User</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="user">Create</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Form User</strong></div>
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

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form id="user-form" action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label" for="nomor_induk">Nomor Induk</label>
                    <input class="form-control" id="nomor_induk" type="text" name="nomor_induk" value="{{ old('nomor_induk') }}" required>
                </div>

            
                
                <div class="mb-3">
                    <label class="form-label" for="name">Nama</label>
                    <input class="form-control" id="name" type="text" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kode_prodi">Prodi</label>
                    <select class="form-select" id="kode_prodi" name="kode_prodi" required>
                        <option value="">Pilih Prodi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
           
                
                
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" required>
                </div>
                
                
                <div class="mb-3">
                    <label class="form-label" for="phone">Telepon</label>
                    <input class="form-control" id="phone" type="text" name="phone">
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="address">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<script>
    $(document).ready(function () {
        $('#user-form').on('submit', function(e) {
            e.preventDefault(); 

            Swal.fire({
                title: 'Apakah data sudah benar?',
                text: "Pastikan semua data sudah terisi dengan benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); 
                }
            });
        });
    });
</script>


@endsection
