@extends('admin.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="container-lg px-4">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-primary-gradient">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">{{ number_format($totalMahasiswa) }} 
              <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                </svg></div>
            <div data-coreui-i18n="users">total mahasiswa</div>
          </div>
  
        </div>
        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
          <canvas class="chart" id="card-chart1" height="70" width="256" style="display: block; box-sizing: border-box; height: 70px; width: 256px;"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-info-gradient">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">{{ number_format($totalKaryawan) }} 
              <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                </svg></div>
            <div data-coreui-i18n="income">daftar karyawan</div>
          </div>
   
        </div>
        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
          <canvas class="chart" id="card-chart2" height="70" width="256" style="display: block; box-sizing: border-box; height: 70px; width: 256px;"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-warning-gradient">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">{{ number_format($totalSurat) }} 
              <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                </svg></div>
            <div data-coreui-i18n="conversionRate">Total surat</div>
          </div>
          
        </div>
        <div class="c-chart-wrapper mt-3" style="height:70px;">
          <canvas class="chart" id="card-chart3" height="70" width="288" style="display: block; box-sizing: border-box; height: 70px; width: 288px;"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-danger-gradient">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">{{ number_format($totalMataKuliah) }} 
              <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                </svg></div>
            <div data-coreui-i18n="sessions">daftar mata kuliah</div>
          </div>

        </div>
        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
          <canvas class="chart" id="card-chart4" height="70" width="256" style="display: block; box-sizing: border-box; height: 70px; width: 256px;"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
  </div>
  <!-- /.row-->

  <!-- /.card.mb-4-->

  <!-- /.row-->
  <div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">History User</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border mb-0">
                        <thead class="fw-semibold text-nowrap">
                            <tr class="align-middle">
                                <th class="bg-body-secondary text-center">#</th>
                                <th class="bg-body-secondary">Profile Picture</th>
                                <th class="bg-body-secondary">Nomor Induk</th>
                                <th class="bg-body-secondary">Nama</th>
                                <th class="bg-body-secondary">Email</th>
                                <th class="bg-body-secondary">Role</th>
                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                  @if($user->profile)
                                    <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                  @else
                                      <i class="fas fa-user-circle fa-3x text-secondary mb-3"></i>
                                  @endif
                                </td>
                                <td>{{ $user->nomor_induk }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td> <!-- Relasi role -->

                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

@endsection