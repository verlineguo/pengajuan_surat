@extends('admin.layouts.app')

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
            <form action="{{ route('admin.user.store') }}" method="POST">
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
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="role">Role</label>
                    <select class="form-select" id="role_id" name="role_id" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="phone">Telepon</label>
                    <input class="form-control" id="phone" type="text" name="phone">
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="address">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
