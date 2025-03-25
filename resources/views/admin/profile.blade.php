@extends('admin.layouts.app')

@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('admin.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="dashboard">Profile</span>
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Profile</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="view-profile-tab" data-bs-toggle="tab" data-bs-target="#view-profile" type="button" role="tab">Lihat Profil</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="edit-profile-tab" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab">Edit Profil</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="profileTabsContent">
                            <!-- Lihat Profil -->
                            <div class="tab-pane fade show active text-center" id="view-profile" role="tabpanel">
                                @if($user->profile)
                                    <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile Picture" class="img-thumbnail rounded-circle mb-3" width="150" height="150" style="object-fit: cover; aspect-ratio: 1 / 1;">
                                @else
                                    <i class="fas fa-user-circle fa-5x text-secondary mb-3"></i>
                                @endif
                            
                                <table class="table table-bordered table-striped mt-3">
                                    <tr><td><strong>Nomor Induk</strong></td><td>{{ $user->nomor_induk }}</td></tr>
                                    <tr><td><strong>Nama</strong></td><td>{{ $user->name }}</td></tr>
                                    <tr><td><strong>Email</strong></td><td>{{ $user->email }}</td></tr>
                                    <tr><td><strong>Role</strong></td><td><span class="badge bg-info">{{ $user->role->name }}</span></td></tr>
                                    <tr><td><strong>Telepon</strong></td><td>{{ $user->phone }}</td></tr>
                                    <tr><td><strong>Alamat</strong></td><td>{{ $user->address }}</td></tr>
                                </table>
                            </div>
                            
                            <!-- Edit Profil -->
                            <div class="tab-pane fade" id="edit-profile" role="tabpanel">
                                <form action="{{ route('admin.user.update', $user->nomor_induk) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 text-center">
                                        <label class="form-label">Foto Profil</label>
                                        <br>
                                        <img id="profilePreview" 
                                             src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('images/default-profile.png') }}" 
                                             alt="Profile Picture" class="img-thumbnail rounded-circle" width="150px" height="150px" style="object-fit: cover; aspect-ratio: 1 / 1;">
                                        <br>
                                        <input class="form-control mt-2" type="file" name="profile" onchange="previewImage(event)">
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
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('profilePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
