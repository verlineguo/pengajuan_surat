@extends('TU.layouts.app')

@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('tu.dashboard')}}" data-coreui-i18n="home">Home</a>
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
<!-- SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.all.min.js"></script>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 3000
                        });
                    });
                </script>
            @endif
            
            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: "{{ session('error') }}",
                            showConfirmButton: true
                        });
                    });
                </script>
            @endif

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="card-title mb-0 text-center">Profil TU</h4>
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
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center justify-content-center" 
                                    id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" 
                                    type="button" role="tab" aria-selected="false">
                                <i class="fas fa-key me-2"></i> Ganti Password
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
                                            @if($user->profile)
                                                <img src="{{ asset('storage/' . $user->profile) }}?v={{ time() }}" 
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
                                        
                                        <h5 class="mb-1">{{ $user->name }}</h5>
                                        <p class="text-muted">{{ $user->role->name }}</p>
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
                                                    <p class="card-text fw-bold">{{ $user->nomor_induk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        <i class="fas fa-envelope me-2"></i>Email
                                                    </h6>
                                                    <p class="card-text fw-bold">{{ $user->email }}</p>
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
                                                        {{ $user->phone ?: 'Belum diisi' }}
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
                                                        <span class="badge bg-info">{{ $user->role->name }}</span>
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
                                                        {{ $user->address ?: 'Belum diisi' }}
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
                            <form action="{{ route('profile.update', ['role' => 'tu']) }}" method="POST" enctype="multipart/form-data" id="profileForm">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="text-center">
                                            <label class="form-label fw-bold">Foto Profil</label>
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="position-relative">
                                                    @if($user->profile)
                                                        <img id="profilePreview" src="{{ asset('storage/' . $user->profile) }}?v={{ time() }}" 
                                                             alt="Profile Picture" 
                                                             class="img-thumbnail rounded-circle" 
                                                             width="180" height="180" 
                                                             style="object-fit: cover; aspect-ratio: 1 / 1;">
                                                    @else
                                                        <img id="profilePreview" src="{{ asset('template/assets/toppng.com-instagram-default-profile-picture-2083x2083.png') }}"
                                                             alt="Default Profile" 
                                                             class="img-thumbnail rounded-circle" 
                                                             width="180" height="180" 
                                                             style="object-fit: cover; aspect-ratio: 1 / 1;">
                                                    @endif
                                                    
                                                    <div class="position-absolute bottom-0 end-0">
                                                        <label for="profileUpload" class="btn btn-sm btn-primary rounded-circle p-2" style="cursor: pointer;">
                                                            <i class="fas fa-camera"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="profileUpload" class="form-control d-none" type="file" name="profile" accept="image/*" onchange="previewImage(event)">
                                            <div class="small text-muted">Klik ikon kamera untuk mengubah foto</div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="nomorInduk" value="{{ $user->nomor_induk }}" disabled>
                                                    <label for="nomorInduk">Nomor Induk</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="nama" value="{{ $user->name }}" disabled>
                                                    <label for="nama">Nama</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Telepon">
                                                    <label for="phone">Telepon</label>
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" style="height: 100px" placeholder="Alamat">{{ old('address', $user->address) }}</textarea>
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
                                    <button type="submit" class="btn btn-primary" id="saveProfileBtn">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Change Password -->
                        <div class="tab-pane fade" id="change-password" role="tabpanel">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-4 text-center">
                                                <i class="fas fa-key me-2"></i>Ganti Password
                                            </h5>

                                            <form action="{{ route('profile.password.update') }}" method="POST" id="passwordForm">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                                           id="current_password" name="current_password" required placeholder="Password Saat Ini">
                                                    <label for="current_password">Password Saat Ini</label>
                                                    @error('current_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                           id="password" name="password" required placeholder="Password Baru">
                                                    <label for="password">Password Baru</label>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-floating mb-4">
                                                    <input type="password" class="form-control" 
                                                           id="password_confirmation" name="password_confirmation" required placeholder="Konfirmasi Password">
                                                    <label for="password_confirmation">Konfirmasi Password</label>
                                                </div>
                                                
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save me-1"></i> Simpan Password Baru
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

    // Add form submission handling with SweetAlert
    document.addEventListener('DOMContentLoaded', function() {
        // Profile form submission
        const profileForm = document.getElementById('profileForm');
        
        if (profileForm) {
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menyimpan perubahan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Menyimpan...',
                            html: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Submit the form
                        profileForm.submit();
                    }
                });
            });
        }

        // Password form submission
        const passwordForm = document.getElementById('passwordForm');
        
        if (passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin mengubah password?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah Password',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Menyimpan...',
                            html: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Submit the form
                        passwordForm.submit();
                    }
                });
            });
        }
        
        // Show appropriate tab based on URL hash if present
        const hash = window.location.hash;
        if (hash) {
            const triggerEl = document.querySelector(`button[data-bs-target="${hash}"]`);
            if(triggerEl) {
                const tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        }
    });
</script>
@endsection