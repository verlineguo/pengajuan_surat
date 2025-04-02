@extends('mahasiswa.layouts.app')
@section('header')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item text-white"><a href="{{ route('mahasiswa.dashboard')}}" data-coreui-i18n="home">Home</a>
        </li>
        <li class="breadcrumb-item text-white"><a href="{{ route('mahasiswa.pengajuan.history')}}" data-coreui-i18n="home">Pengajuan</a>
        </li>
        <li class="breadcrumb-item active"><span data-coreui-i18n="pengajuan">Edit Surat</span>

      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container-lg px-4">
    <div class="card mb-4">
        <div class="card-header"><strong>Edit Pengajuan Surat</strong></div>
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

            <form action="{{ route('mahasiswa.pengajuan.update', $pengajuan->id_pengajuan) }}" method="POST">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="id_surat" value="{{ $pengajuan->id_surat }}">
                
                <div class="mb-3">
                    <label class="form-label">Jenis Surat</label>
                    <input class="form-control" type="text" value="{{ $pengajuan->surat->nama_jenis_surat }}" readonly>
                </div>

                <div id="form-surat">
                    @if ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Mahasiswa Aktif')
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input class="form-control" type="text" name="name"  value="{{ $mahasiswa->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NRP</label>
                            <input class="form-control" type="text" name="nrp" value="{{ $mahasiswa->nomor_induk }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input class="form-control" type="number" name="semester" value="{{ $pengajuan->skma->semester }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap di Bandung</label>
                            <input class="form-control" type="text" name="alamat_bandung" value="{{ $pengajuan->skma->alamat_bandung }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keperluan Pengajuan</label>
                            <textarea class="form-control" name="keperluan" required>{{ $pengajuan->skma->keperluan }}</textarea>
                        </div>
                    @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Pengantar Tugas Mata Kuliah')
                        <div class="mb-3">
                            <label class="form-label">Surat Ditujukan Kepada</label>
                            <input class="form-control" type="text" name="tujukan" value="{{ $pengajuan->sptmk->tujukan }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Mata Kuliah - Kode Mata Kuliah</label>
                            <div class="form-text">Contoh: Proses Bisnis - IN255</div>
                            <input class="form-control" type="text" name="mata_kuliah" value="{{ $pengajuan->sptmk->mata_kuliah }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <div class="form-text">Isikan dengan semester yang sedang ditempuh saat ini (contoh: Semester Genap 23/24)</div>
                            <input class="form-control" type="text" name="semester" value="{{ $pengajuan->sptmk->semester }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data Mahasiswa</label>
                            <div class="form-text">Informasikan nama dan NRP tiap mahasiswa (contoh: Mahasiswa 1 - 15720xx; Mahasiswa 2 - 15720xx; Mahasiswa 3 - 15720xx; dst)</div>
                            <input class="form-control" type="text" name="data_mahasiswa" value="{{ $pengajuan->sptmk->data_mahasiswa }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tujuan</label>
                            <input class="form-control" name="tujuan" value="{{ $pengajuan->sptmk->tujuan }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Topik</label>
                            <textarea class="form-control" name="topik" required>{{ $pengajuan->sptmk->topik }}</textarea>
                        </div>
                    @elseif ($pengajuan->surat->nama_jenis_surat === 'Surat Keterangan Lulus')
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="form-text"> Isikan dengan nama lengkap dalam format Huruf Besar - Huruf Kecil (contoh: Susi Susanti)</div>
                            <input class="form-control" type="text" name="name" value="{{ $mahasiswa->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NRP</label>
                            <input class="form-control" type="text" name="nrp" value="{{ $mahasiswa->nomor_induk }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kelulusan</label>
                            <input class="form-control" type="date" name="tanggal_kelulusan" value="{{ $pengajuan->skl->tanggal_kelulusan }}" required>
                        </div>
                    @elseif ($pengajuan->surat->nama_jenis_surat === 'Laporan Hasil Studi')
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="form-text"> Isikan dengan nama lengkap dalam format Huruf Besar - Huruf Kecil (contoh: Susi Susanti)</div>
                            <input class="form-control" type="text" name="name"  value="{{ $mahasiswa->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NRP</label>
                            <input class="form-control" type="text" name="nrp"  value="{{ $mahasiswa->nomor_induk }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keperluan Pembuatan LHS</label>
                            <textarea class="form-control" name="keperluan" required>{{ $pengajuan->lhs->keperluan }}</textarea>
                        </div>
                    @endif

                </div>

                <button type="submit" class="btn btn-primary">Update Pengajuan</button>
            </form>
        </div>
    </div>
</div>
@endsection