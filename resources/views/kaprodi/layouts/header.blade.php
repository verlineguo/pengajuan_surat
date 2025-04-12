<header class="header header-sticky p-0 mb-4">
        <div class="container-fluid px-4 border-bottom">
          <button class="header-toggler" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()" style="margin-inline-start: -14px">
            <svg class="icon icon-lg">
              <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button>
          {{-- <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#" data-coreui-i18n="settings">Settings</a></li>
          </ul> --}}
          <ul class="header-nav d-none d-md-flex ms-auto">
            <li class="nav-item dropdown"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-lg my-1 mx-2">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient">5</span></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="notificationsCounter, { 'counter': 5 }">You have 5 notifications</div><a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-success">
                    <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-user-follow"></use>
                  </svg><span data-coreui-i18n="newUserRegistered">New user registered</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-danger">
                    <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-user-unfollow"></use>
                  </svg><span data-coreui-i18n="userDeleted">User deleted</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-info">
                    <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
                  </svg><span data-coreui-i18n="salesReportIsReady">Sales report is ready</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-success">
                    <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
                  </svg><span data-coreui-i18n="newClient">New client</span></a><a class="dropdown-item" href="#">
              </div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-lg my-1 mx-2">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-info-gradient">7</span></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-md pt-0" style="min-width: 24rem">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="messagesCounter, { 'counter': 7 }">You have 4 messages</div><a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="{{ asset('template') }}/assets/img/avatars/1.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    <div class="message text-wrap">
                      <div class="d-flex justify-content-between mt-1">
                        <div class="small text-body-secondary">Jessica Williams</div>
                        <div class="small text-body-secondary">Just now</div>
                      </div>
                      <div class="fw-semibold"><span class="text-danger">! </span>Urgent: System Maintenance Tonight</div>
                      <div class="small text-body-secondary">Attention team, we'll be conducting critical system maintenance tonight from 10 PM to 2 AM. Plan accordingly...</div>
                    </div>
                  </div>
                </a><a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="{{ asset('template') }}/assets/img/avatars/2.jpg" alt="user@email.com"><span class="avatar-status bg-warning"></span></div>
                    <div class="message text-wrap">
                      <div class="d-flex justify-content-between mt-1">
                        <div class="small text-body-secondary">Richard Johnson</div>
                        <div class="small text-body-secondary">5 minutes ago</div>
                      </div>
                      <div class="fw-semibold"><span class="text-danger">! </span>Project Update: Milestone Achieved</div>
                      <div class="small text-body-secondary">Kudos on hitting sales targets last quarter! Let's keep the momentum. New goals, new victories ahead...</div>
                    </div>
                  </div>
                </a><a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="{{ asset('template') }}/assets/img/avatars/4.jpg" alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
                    <div class="message text-wrap">
                      <div class="d-flex justify-content-between mt-1">
                        <div class="small text-body-secondary">Angela Rodriguez</div>
                        <div class="small text-body-secondary">1:52 PM</div>
                      </div>
                      <div class="fw-semibold">Social Media Campaign Launch</div>
                      <div class="small text-body-secondary">Exciting news! Our new social media campaign goes live tomorrow. Brace yourselves for engagement...</div>
                    </div>
                  </div>
                </a><a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="{{ asset('template') }}/assets/img/avatars/5.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    <div class="message text-wrap">
                      <div class="d-flex justify-content-between mt-1">
                        <div class="small text-body-secondary">Jane Lewis</div>
                        <div class="small text-body-secondary">4:03 PM</div>
                      </div>
                      <div class="fw-semibold">Inventory Checkpoint</div>
                      <div class="small text-body-secondary">Team, it's time for our monthly inventory check. Accurate counts ensure smooth operations. Let's nail it...</div>
                    </div>
                  </div>
                </a><a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="{{ asset('template') }}/assets/img/avatars/3.jpg" alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
                    <div class="message text-wrap">
                      <div class="d-flex justify-content-between mt-1">
                        <div class="small text-body-secondary">Ryan Miller</div>
                        <div class="small text-body-secondary">3 days ago</div>
                      </div>
                      <div class="fw-semibold">Customer Feedback Results</div>
                      <div class="small text-body-secondary">Our latest customer feedback is in. Let's analyze and discuss improvements for an even better service...</div>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div><a class="dropdown-item text-center fw-semibold" href="#" data-coreui-i18n="viewAllMessages">View all messages</a>
              </div>
            </li>
          </ul>
          <ul class="header-nav ms-auto ms-md-0">
            <li class="nav-item py-1">
              <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            
            <li class="nav-item dropdown">
              <button class="btn btn-link nav-link" type="button" aria-expanded="false" data-coreui-toggle="dropdown">
                <svg class="icon icon-lg theme-icon-active">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-contrast"></use>
                </svg>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                <li>
                  <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="light">
                    <svg class="icon icon-lg me-3">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-sun"></use>
                    </svg><span data-coreui-i18n="light">Light</span>
                  </button>
                </li>
                <li>
                  <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                    <svg class="icon icon-lg me-3">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-moon"></use>
                    </svg><span data-coreui-i18n="dark"> Dark</span>
                  </button>
                </li>
                <li>
                  <button class="dropdown-item d-flex align-items-center active" type="button" data-coreui-theme-value="auto">
                    <svg class="icon icon-lg me-3">
                      <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-contrast"></use>
                    </svg>Auto
                  </button>
                </li>
              </ul>
            </li>
            <li class="nav-item py-1">
              <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-md">
                @if($kaprodi->profile)
                  <img src="{{ asset('storage/' . $kaprodi->profile) }}" alt="Profile" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                @else
                    <i class="fas fa-user-circle fa-3x text-secondary"></i>
                @endif
              </div>
            </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2" data-coreui-i18n="settings">Settings</div><a class="dropdown-item" href="#">
                  <a class="dropdown-item" href="{{ route('kaprodi.profile') }}"> <svg class="icon me-2">
                    <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg><span data-coreui-i18n="profile">Profile</span></a>
            
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  
                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <svg class="icon me-2">
                          <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                      </svg>
                      Logout
                  </a>
                  
              </div>
            </li>
          </ul>
          
        </div>
        <div class="container-fluid px-4">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
              <li class="breadcrumb-item"><a href="{{ route('kaprodi.dashboard')}}" data-coreui-i18n="home">Home</a>
              </li>
              <li class="breadcrumb-item active"><span data-coreui-i18n="dashboard">Dashboard</span>
              </li>
            </ol>
          </nav>
        </div>
      </header>