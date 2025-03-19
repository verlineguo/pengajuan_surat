@extends('mahasiswa.layouts.app')
@section('content')
<div class="container-lg px-4">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-primary-gradient">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                </svg>)</span></div>
            <div data-coreui-i18n="users">total mahasiswa</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="action">action</a><a class="dropdown-item" href="#" data-coreui-i18n="anotherAction">anotherAction</a><a class="dropdown-item" href="#" data-coreui-i18n="somethingElseHere">somethingElseHere</a></div>
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
            <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal">(40.9%
                <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                </svg>)</span></div>
            <div data-coreui-i18n="income">pengajuan surat</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="action">action</a><a class="dropdown-item" href="#" data-coreui-i18n="anotherAction">anotherAction</a><a class="dropdown-item" href="#" data-coreui-i18n="somethingElseHere">somethingElseHere</a></div>
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
            <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                </svg>)</span></div>
            <div data-coreui-i18n="conversionRate">pengajuan surat pending</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="action">action</a><a class="dropdown-item" href="#" data-coreui-i18n="anotherAction">anotherAction</a><a class="dropdown-item" href="#" data-coreui-i18n="somethingElseHere">somethingElseHere</a></div>
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
            <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                <svg class="icon">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                </svg>)</span></div>
            <div data-coreui-i18n="sessions">sessions</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="action">action</a><a class="dropdown-item" href="#" data-coreui-i18n="anotherAction">anotherAction</a><a class="dropdown-item" href="#" data-coreui-i18n="somethingElseHere">somethingElseHere</a></div>
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
        <div class="card-header" data-coreui-i18n="trafficAndSales">History Pengajuan</div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table border mb-0">
              <thead class="fw-semibold text-nowrap">
                <tr class="align-middle">
                  <th class="bg-body-secondary text-center">
                    <svg class="icon">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                    </svg>
                  </th>
                  <th class="bg-body-secondary" data-coreui-i18n="user">user</th>
                  <th class="bg-body-secondary text-center" data-coreui-i18n="country">country</th>
                  <th class="bg-body-secondary" data-coreui-i18n="usage">usage</th>
                  <th class="bg-body-secondary text-center" data-coreui-i18n="paymentMethod">paymentMethod</th>
                  <th class="bg-body-secondary" data-coreui-i18n="activity">activity</th>
                  <th class="bg-body-secondary"></th>
                </tr>
              </thead>
              <tbody>
                <tr class="align-middle">
                  <td class="text-center">
                    <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('template') }}/assets/img/avatars/1.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                  </td>
                  <td>
                    <div class="text-nowrap">Yiorgos Avraamu</div>
                    <div class="small text-body-secondary text-nowrap"><span data-coreui-i18n="new">new</span> | <span data-coreui-i18n="registered">registered</span><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 1, 10'}">dateShortMonthName</span></div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/flag.svg#cif-us"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="d-flex justify-content-between align-items-baseline">
                      <div class="fw-semibold">50%</div>
                      <div class="text-nowrap small text-body-secondary ms-3"><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 6, 11'}">dateShortMonthName</span> - <span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 7, 10'}">dateShortMonthName</span></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="small text-body-secondary" data-coreui-i18n="lastLogin">lastLogin</div>
                    <div class="fw-semibold text-nowrap" data-coreui-i18n="relativeTime, { 'val': -10, 'range': 'seconds' }">relativeTime</div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-transparent p-0 dark:text-high-emphasis" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="info">info</a><a class="dropdown-item" href="#" data-coreui-i18n="edit">edit</a><a class="dropdown-item text-danger" href="#" data-coreui-i18n="delete">delete</a></div>
                    </div>
                  </td>
                </tr>
                <tr class="align-middle">
                  <td class="text-center">
                    <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('template') }}/assets/img/avatars/2.jpg" alt="user@email.com"><span class="avatar-status bg-danger-gradient"></span></div>
                  </td>
                  <td>
                    <div class="text-nowrap">Avram Tarasios</div>
                    <div class="small text-body-secondary text-nowrap"><span data-coreui-i18n="recurring">recurring</span> | <span data-coreui-i18n="registered">registered</span><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 1, 10'}">dateShortMonthName</span></div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/flag.svg#cif-br"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="d-flex justify-content-between align-items-baseline">
                      <div class="fw-semibold">10%</div>
                      <div class="text-nowrap small text-body-secondary ms-3"><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 6, 11'}">dateShortMonthName</span> - <span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 7, 10'}">dateShortMonthName</span></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/brand.svg#cib-cc-visa"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="small text-body-secondary" data-coreui-i18n="lastLogin">lastLogin</div>
                    <div class="fw-semibold text-nowrap" data-coreui-i18n="relativeTime, { 'val': -5, 'range': 'minutes' }">relativeTime</div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-transparent p-0 dark:text-high-emphasis" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="info">info</a><a class="dropdown-item" href="#" data-coreui-i18n="edit">edit</a><a class="dropdown-item text-danger" href="#" data-coreui-i18n="delete">delete</a></div>
                    </div>
                  </td>
                </tr>
                <tr class="align-middle">
                  <td class="text-center">
                    <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/3.jpg" alt="user@email.com"><span class="avatar-status bg-warning-gradient"></span></div>
                  </td>
                  <td>
                    <div class="text-nowrap">Quintin Ed</div>
                    <div class="small text-body-secondary text-nowrap"><span data-coreui-i18n="new">new</span> | <span data-coreui-i18n="registered">registered</span><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 1, 10'}">dateShortMonthName</span></div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-in"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="d-flex justify-content-between align-items-baseline">
                      <div class="fw-semibold">74%</div>
                      <div class="text-nowrap small text-body-secondary ms-3"><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 6, 11'}">dateShortMonthName</span> - <span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 7, 10'}">dateShortMonthName</span></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-warning-gradient" role="progressbar" style="width: 74%" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-stripe"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="small text-body-secondary" data-coreui-i18n="lastLogin">lastLogin</div>
                    <div class="fw-semibold text-nowrap" data-coreui-i18n="relativeTime, { 'val': -1, 'range': 'hours' }">relativeTime</div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-transparent p-0 dark:text-high-emphasis" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="info">info</a><a class="dropdown-item" href="#" data-coreui-i18n="edit">edit</a><a class="dropdown-item text-danger" href="#" data-coreui-i18n="delete">delete</a></div>
                    </div>
                  </td>
                </tr>
                <tr class="align-middle">
                  <td class="text-center">
                    <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/4.jpg" alt="user@email.com"><span class="avatar-status bg-secondary-gradient"></span></div>
                  </td>
                  <td>
                    <div class="text-nowrap">Enéas Kwadwo</div>
                    <div class="small text-body-secondary text-nowrap"><span data-coreui-i18n="new">new</span> | <span data-coreui-i18n="registered">registered</span><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 1, 10'}">dateShortMonthName</span></div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-fr"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="d-flex justify-content-between align-items-baseline">
                      <div class="fw-semibold">98%</div>
                      <div class="text-nowrap small text-body-secondary ms-3"><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 6, 11'}">dateShortMonthName</span> - <span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 7, 10'}">dateShortMonthName</span></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 98%" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-paypal"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="small text-body-secondary" data-coreui-i18n="lastLogin">lastLogin</div>
                    <div class="fw-semibold text-nowrap" data-coreui-i18n="relativeTime, { 'val': -1, 'range': 'weeks' }">relativeTime</div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-transparent p-0 dark:text-high-emphasis" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="info">info</a><a class="dropdown-item" href="#" data-coreui-i18n="edit">edit</a><a class="dropdown-item text-danger" href="#" data-coreui-i18n="delete">delete</a></div>
                    </div>
                  </td>
                </tr>
                <tr class="align-middle">
                  <td class="text-center">
                    <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/5.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                  </td>
                  <td>
                    <div class="text-nowrap">Agapetus Tadeáš</div>
                    <div class="small text-body-secondary text-nowrap"><span data-coreui-i18n="new">new</span> | <span data-coreui-i18n="registered">registered</span><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 1, 10'}">dateShortMonthName</span></div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-es"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="d-flex justify-content-between align-items-baseline">
                      <div class="fw-semibold">22%</div>
                      <div class="text-nowrap small text-body-secondary ms-3"><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 6, 11'}">dateShortMonthName</span> - <span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 7, 18'}">dateShortMonthName</span></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-apple-pay"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="small text-body-secondary" data-coreui-i18n="lastLogin">lastLogin</div>
                    <div class="fw-semibold text-nowrap" data-coreui-i18n="relativeTime, { 'val': -3, 'range': 'months' }">relativeTime</div>
                  </td>
                  <td>
                    <div class="dropdown dropup">
                      <button class="btn btn-transparent p-0 dark:text-high-emphasis" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="info">info</a><a class="dropdown-item" href="#" data-coreui-i18n="edit">edit</a><a class="dropdown-item text-danger" href="#" data-coreui-i18n="delete">delete</a></div>
                    </div>
                  </td>
                </tr>
                <tr class="align-middle">
                  <td class="text-center">
                    <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/6.jpg" alt="user@email.com"><span class="avatar-status bg-danger-gradient"></span></div>
                  </td>
                  <td>
                    <div class="text-nowrap">Friderik Dávid</div>
                    <div class="small text-body-secondary text-nowrap"><span data-coreui-i18n="new">new</span> | <span data-coreui-i18n="registered">registered</span><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 1, 10'}">dateShortMonthName</span></div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-pl"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="d-flex justify-content-between align-items-baseline">
                      <div class="fw-semibold">43%</div>
                      <div class="text-nowrap small text-body-secondary ms-3"><span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 6, 11'}">dateShortMonthName</span> - <span data-coreui-i18n-date="dateShortMonthName, { 'date': '2023, 7, 10'}">dateShortMonthName</span></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-amex"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="small text-body-secondary" data-coreui-i18n="lastLogin">lastLogin</div>
                    <div class="fw-semibold text-nowrap" data-coreui-i18n="relativeTime, { 'val': -1, 'range': 'years' }">relativeTime</div>
                  </td>
                  <td>
                    <div class="dropdown dropup">
                      <button class="btn btn-transparent p-0 dark:text-high-emphasis" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#" data-coreui-i18n="info">info</a><a class="dropdown-item" href="#" data-coreui-i18n="edit">edit</a><a class="dropdown-item text-danger" href="#" data-coreui-i18n="delete">delete</a></div>
                    </div>
                  </td>
                </tr>
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

@endsection