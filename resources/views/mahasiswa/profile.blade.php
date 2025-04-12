@extends('mahasiswa.layouts.app')

@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('mahasiswa.dashboard')}}" data-coreui-i18n="home">Home</a>
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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow border-0">
                <div class="card-header bg-secondary text-white py-3">
                    <h4 class="card-title mb-0 text-center">Profil Mahasiswa</h4>
                </div>
                
                <div class="card-body p-0">
                    <ul class="nav nav-pills nav-fill p-3" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active d-flex align-items-center justify-content-center" 
                                    id="view-profile-tab" data-bs-toggle="tab" data-bs-target="#view-profile" 
                                    type="button" role="tab" aria-selected="true">
                                <i class="fas fa-user-circle me-2"></i> Lihat Profil
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center justify-content-center" 
                                    id="edit-profile-tab" data-bs-toggle="tab" data-bs-target="#edit-profile" 
                                    type="button" role="tab" aria-selected="false">
                                <i class="fas fa-edit me-2"></i> Edit Profil
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content p-4" id="profileTabsContent">
                        <!-- Lihat Profil -->
                        <div class="tab-pane fade show active" id="view-profile" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block mb-3">
                                            @if($mahasiswa->profile)
                                                <img src="{{ asset('storage/' . $mahasiswa->profile) }}" 
                                                     alt="Profile Picture" 
                                                     class="img-thumbnail rounded-circle" 
                                                     width="180" height="180" 
                                                     style="object-fit: cover; aspect-ratio: 1 / 1;">
                                            @else
                                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 180px; height: 180px;">
                                                    <i class="fas fa-user-circle fa-5x text-secondary"></i>
                                                </div>
                                            @endif
                                            
                                            <div class="badge bg-success position-absolute bottom-0 end-0 p-2 rounded-circle">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        
                                        <h5 class="mb-1">{{ $mahasiswa->name }}</h5>
                                        <p class="text-muted">{{ $mahasiswa->role->name }}</p>
                                    </div>
                                </div>
                                
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        <i class="fas fa-id-card me-2"></i>Nomor Induk
                                                    </h6>
                                                    <p class="card-text fw-bold">{{ $mahasiswa->nomor_induk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        <i class="fas fa-envelope me-2"></i>Email
                                                    </h6>
                                                    <p class="card-text fw-bold">{{ $mahasiswa->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        <i class="fas fa-phone me-2"></i>Telepon
                                                    </h6>
                                                    <p class="card-text fw-bold">
                                                        {{ $mahasiswa->phone ?: 'Belum diisi' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        <i class="fas fa-user-tag me-2"></i>Role
                                                    </h6>
                                                    <p class="card-text">
                                                        <span class="badge bg-info">{{ $mahasiswa->role->name }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="card h-100 border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        <i class="fas fa-map-marker-alt me-2"></i>Alamat
                                                    </h6>
                                                    <p class="card-text">
                                                        {{ $mahasiswa->address ?: 'Belum diisi' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Profil -->
                        <div class="tab-pane fade" id="edit-profile" role="tabpanel">
                            <form action="{{ route('mahasiswa.user.update', $mahasiswa->nomor_induk) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="text-center">
                                            <label class="form-label fw-bold">Foto Profil</label>
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="position-relative">
                                                   
                                                         @if($mahasiswa->profile)
                                                <img id="profilePreview" src="{{ asset('storage/' . $mahasiswa->profile) }}" 
                                                     alt="Profile Picture" 
                                                     class="img-thumbnail rounded-circle" 
                                                     width="180" height="180" 
                                                     style="object-fit: cover; aspect-ratio: 1 / 1;">
                                            @else
                                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 180px; height: 180px;">
                                                    <i class="fas fa-user-circle fa-5x text-secondary"></i>
                                                </div>
                                            @endif
                                                    
                                                    <div class="position-absolute bottom-0 end-0">
                                                        <label for="profileUpload" class="btn btn-sm btn-primary rounded-circle p-2" style="cursor: pointer;">
                                                            <i class="fas fa-camera"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="profileUpload" class="form-control d-none" type="file" name="profile" onchange="previewImage(event)">
                                            <div class="small text-muted">Klik ikon kamera untuk mengubah foto</div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="nomorInduk" value="{{ $mahasiswa->nomor_induk }}" disabled>
                                                    <label for="nomorInduk">Nomor Induk</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="nama" value="{{ $mahasiswa->name }}" disabled>
                                                    <label for="nama">Nama</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="email" value="{{ $mahasiswa->email }}" disabled>
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="text" name="phone" value="{{ old('phone', $mahasiswa->phone) }}" placeholder="Telepon">
                                                    <label for="phone">Telepon</label>
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Password">
                                                    <label for="password">Password (Kosongkan jika tidak ingin diubah)</label>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" style="height: 100px" placeholder="Alamat">{{ old('address', $mahasiswa->address) }}</textarea>
                                                    <label for="address">Alamat</label>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="tab" data-bs-target="#view-profile">
                                        <i class="fas fa-times me-1"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
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

    // Auto-close alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection