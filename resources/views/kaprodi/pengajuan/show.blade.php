@extends('kaprodi.layouts.app') 
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('kaprodi.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('kaprodi.pengajuan')}}" data-coreui-i18n="dashboard">Pengajuan</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="user">Show</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container p-5">
    <h2 class="mb-4">Detail Pengajuan Surat</h2>
    <div class="card shadow-lg rounded-3 mb-4 border-0 overflow-hidden">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <i class="fas fa-file-signature text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted">Nama Surat</small>
                            <p class="mb-0 fw-bold">{{ $pengajuan->surat->nama_jenis_surat }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <i class="fas fa-calendar-alt text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted">Tanggal Pengajuan</small>
                            <p class="mb-0 fw-bold">{{ $pengajuan->tanggal_pengajuan->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($pengajuan->tanggal_persetujuan)
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <i class="fas fa-calendar-check text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted">Tanggal Persetujuan</small>
                            <p class="mb-0 fw-bold">{{ $pengajuan->tanggal_persetujuan->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <i class="fas fa-tasks text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted">Status</small>
                            <div>
                                @if($pengajuan->status_pengajuan === 'Disetujui')
                                    <span class="badge bg-success fs-6"><i class="fas fa-check-circle me-1"></i>{{ $pengajuan->status_pengajuan }}</span>
                                @elseif($pengajuan->status_pengajuan === 'Ditolak')
                                    <span class="badge bg-danger fs-6"><i class="fas fa-times-circle me-1"></i>{{ $pengajuan->status_pengajuan }}</span>
                                @elseif($pengajuan->status_pengajuan === 'pending')
                                    <span class="badge bg-warning text-dark fs-6"><i class="fas fa-clock me-1"></i>{{ $pengajuan->status_pengajuan }}</span>
                                @elseif($pengajuan->status_pengajuan === 'Done')
                                    <span class="badge bg-primary fs-6"><i class="fas fa-check-double me-1"></i>{{ $pengajuan->status_pengajuan }}</span>
                                @else
                                    <span class="badge bg-secondary fs-6">{{ $pengajuan->status_pengajuan }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <i class="fas fa-comment-alt text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted">Catatan Kaprodi</small>
                            <p class="mb-0 fw-bold">{{ $pengajuan->catatan_kaprodi ? $pengajuan->catatan_kaprodi : '-' }}</p>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            @if($pengajuan->status_pengajuan === 'pending')
                <form id="pengajuanForm" action="{{ route('kaprodi.pengajuan.update', ['id_pengajuan' => $pengajuan->id_pengajuan]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status_pengajuan" id="status_pengajuan">
                    
                    <div class="mb-2">
                        <label for="catatan_kaprodi" class="form-label">Catatan Kaprodi (Opsional)</label>
                        <textarea name="catatan_kaprodi" id="catatan_kaprodi" class="form-control"></textarea>
                    </div>
                

                    <button type="button" class="btn btn-success text-white approve-btn" data-id_pengajuan="{{ $pengajuan->id_pengajuan }}">
                        Setujui
                    </button>
                    
                    <button type="button" class="btn btn-danger text-white reject-btn" data-id_pengajuan="{{ $pengajuan->id_pengajuan }}">
                        Menolak
                    </button>
                </form>
                
            

            
            @endif
            @if($pengajuan->status_pengajuan === 'disetujui' || $pengajuan->status_pengajuan === 'Done')
            <div class="row">
                <div class="col-md-6">
            
                    
                    @if($pengajuan->tanggal_persetujuan)
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <i class="fas fa-calendar-check text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted">Tanggal Persetujuan</small>
                            <p class="mb-0 fw-bold">{{ $pengajuan->tanggal_persetujuan ? $pengajuan->tanggal_persetujuan->format('d-m-Y H:i') : '-' }}</p>                        </div>
                    </div>
                    @endif
                </div>
    
                
            
                
            </div>
            @endif
            @if($pengajuan->file_surat && $pengajuan->status_pengajuan === 'Done')
            <div class="mt-4 text-start">
                <a href="{{ asset('uploads/surat/' . $pengajuan->file_surat) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-download me-2"></i>Download Surat
                </a>
            </div>
            @endif
        </div>
    </div>

    <div class="card mt-4 shadow-lg">
        <div class="card-body">
            <h5 class="card-title mb-3">Detail Surat</h5>
            <table class="table table-bordered table-striped">
                @if ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Mahasiswa Aktif')
                    <tr class="bg-light">
                        <td><strong>Semester</strong></td>
                        <td>{{ $pengajuan->skma->semester }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat Bandung</strong></td>
                        <td>{{ $pengajuan->skma->alamat_bandung }}</td>
                    </tr>
                    <tr class="bg-light">
                        <td><strong>Keperluan</strong></td>
                        <td>{{ $pengajuan->skma->keperluan }}</td>
                    </tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Pengantar Tugas Mata Kuliah')
                    <tr class="bg-light">
                        <td><strong>Surat Ditujukan Kepada</strong></td>
                        <td>{{ $pengajuan->sptmk->tujukan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mata Kuliah</strong></td>
                        <td>{{ $pengajuan->sptmk->mata_kuliah }}</td>
                    </tr>
                    <tr class="bg-light">
                        <td><strong>Semester</strong></td>
                        <td>{{ $pengajuan->sptmk->semester }}</td>
                    </tr>
                    <tr>
                        <td><strong>Data Mahasiswa</strong></td>
                        <td>{{ $pengajuan->sptmk->data_mahasiswa }}</td>
                    </tr>
                    <tr class="bg-light">
                        <td><strong>Tujuan</strong></td>
                        <td>{{ $pengajuan->sptmk->tujuan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Topik</strong></td>
                        <td>{{ $pengajuan->sptmk->topik }}</td>
                    </tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Lulus')
                    <tr class="bg-light">
                        <td><strong>Nama</strong></td>
                        <td>{{ $pengajuan->mahasiswa->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>NRP</strong></td>
                        <td>{{ $pengajuan->mahasiswa->nomor_induk }}</td>
                    </tr>
                    <tr class="bg-light">
                        <td><strong>Tanggal Kelulusan</strong></td>
                        <td>{{ $pengajuan->skl->tanggal_kelulusan ? $pengajuan->skl->tanggal_kelulusan->format('d-m-Y') : '-' }}</td>
                    </tr>
                @elseif ($pengajuan->surat->nama_jenis_surat === 'Laporan Hasil Studi')
                    <tr class="bg-light">
                        <td><strong>Nama</strong></td>
                        <td>{{ $pengajuan->mahasiswa->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>NRP</strong></td>
                        <td>{{ $pengajuan->mahasiswa->nomor_induk }}</td>
                    </tr>
                    <tr class="bg-light">
                        <td><strong>Keperluan</strong></td>
                        <td>{{ $pengajuan->lhs->keperluan }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    <a href="{{ route('kaprodi.pengajuan') }}" class="btn btn-primary mt-4 mb-4">Kembali</a>
</div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function submitForm(status) {
        document.getElementById('status_pengajuan').value = status;
        document.getElementById('pengajuanForm').submit();
    }

    
    $('.approve-btn').click(function () {
            var pengajuanId = $(this).data('id_pengajuan');
console.log(pengajuanId);
            Swal.fire({
                title: 'Setujui Pengajuan?',
                text: "Anda akan menyetujui pengajuan ini.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('kaprodi/pengajuan') }}/" + pengajuanId + "/approve", {
                        _token: '{{ csrf_token() }}'
                    }, function (data) {
                        Swal.fire(
                            'Berhasil!',
                            'Pengajuan telah disetujui.',
                            'success'
                        ).then(() => location.reload());
                    }).fail(function () {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menyetujui.',
                            'error'
                        );
                    });
                }
            });
        });

        $('.reject-btn').click(function () {
            var pengajuanId = $(this).data('id_pengajuan');

            Swal.fire({
                title: 'Tolak Pengajuan?',
                text: "Anda akan menolak pengajuan ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('kaprodi/pengajuan') }}/" + pengajuanId + "/reject", {
                        _token: '{{ csrf_token() }}'
                    }, function (data) {
                        Swal.fire(
                            'Ditolak!',
                            'Pengajuan telah ditolak.',
                            'success'
                        ).then(() => location.reload());
                    }).fail(function () {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menolak.',
                            'error'
                        );
                    });
                }
            });
        });
    

</script>


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

@endsection
