@extends('mahasiswa.layouts.app')
@section('content')
    <div class="container-lg px-4">
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card text-white bg-primary-gradient">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">{{ $pengajuans->count() }} </div>
                            <div data-coreui-i18n="users">Total Pengajuan surat</div>
                        </div>

                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas class="chart" id="card-chart1" height="70" width="256"
                            style="display: block; box-sizing: border-box; height: 70px; width: 256px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-xl-3">
                <div class="card text-white bg-info-gradient">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">{{ $pengajuanDiterima->count() }} <span class="fs-6 fw-normal">
                                </span></div>
                            <div data-coreui-i18n="income">Pengajuan surat diterima</div>
                        </div>

                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas class="chart" id="card-chart2" height="70" width="256"
                            style="display: block; box-sizing: border-box; height: 70px; width: 256px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-xl-3">
                <div class="card text-white bg-warning-gradient">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">{{ $pengajuanPending->count() }} </div>
                            <div data-coreui-i18n="conversionRate">Pengajuan surat pending</div>
                        </div>

                    </div>
                    <div class="c-chart-wrapper mt-3" style="height:70px;">
                        <canvas class="chart" id="card-chart3" height="70" width="288"
                            style="display: block; box-sizing: border-box; height: 70px; width: 288px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-xl-3">
                <div class="card text-white bg-danger-gradient">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">{{ $pengajuanDitolak->count() }} </div>
                            <div data-coreui-i18n="sessions">Pengajuan surat ditolak</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-options">
                                    </use>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#"
                                    data-coreui-i18n="action">action</a><a class="dropdown-item" href="#"
                                    data-coreui-i18n="anotherAction">anotherAction</a><a class="dropdown-item"
                                    href="#" data-coreui-i18n="somethingElseHere">somethingElseHere</a></div>
                        </div>
                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas class="chart" id="card-chart4" height="70" width="256"
                            style="display: block; box-sizing: border-box; height: 70px; width: 256px;"></canvas>
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
                    <div class="card-header" data-coreui-i18n="trafficAndSales">History Pengajuan</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border mb-0">
                                <thead class="fw-semibold text-nowrap">
                                    <tr class="align-middle">
                                        <th>No</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Catatan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuans as $index => $pengajuan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pengajuan->surat->nama_jenis_surat }}</td>
                                            <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                                            <td>
                                                @if ($pengajuan->status_pengajuan === 'Disetujui')
                                                    <span class="badge bg-success">{{ $pengajuan->status_pengajuan }}</span>
                                                @elseif($pengajuan->status_pengajuan === 'Ditolak')
                                                    <span class="badge bg-danger">{{ $pengajuan->status_pengajuan }}</span>
                                                @elseif($pengajuan->status_pengajuan === 'pending')
                                                    <span
                                                        class="badge bg-warning text-dark">{{ $pengajuan->status_pengajuan }}</span>
                                                @elseif($pengajuan->status_pengajuan === 'Done')
                                                    <span
                                                        class="badge bg-primary">{{ $pengajuan->status_pengajuan }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ $pengajuan->status_pengajuan }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pengajuan->status_pengajuan == 'pending')
                                                    Masih menunggu persetujuan kaprodi
                                                @elseif ($pengajuan->status_pengajuan == 'Disetujui')
                                                    Tunggu upload dari TU
                                                @elseif ($pengajuan->status_pengajuan == 'Done')
                                                    Proses sudah berakhir
                                                @elseif ($pengajuan->status_pengajuan == 'Ditolak')
                                                    {{ $pengajuan->catatan_penolakan ?? 'Alasan tidak tersedia' }}
                                                @else
                                                    -
                                                @endif
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.table').DataTable();

            $('.delete-btn').click(function() {
                var pengajuanId = $(this).data('id_pengajuan');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pengajuan ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/mahasiswa/pengajuan/delete/' + pengajuanId,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                Swal.fire(
                                    'Terhapus!',
                                    'Surat berhasil dihapus.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat menghapus.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
