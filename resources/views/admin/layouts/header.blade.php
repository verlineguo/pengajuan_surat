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
                @if($user->profile)
                  <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                @else
                    <i class="fas fa-user-circle fa-3x text-secondary"></i>
                @endif
              </div>
            </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2" data-coreui-i18n="settings">Settings</div><a class="dropdown-item" href="#">
                  <a class="dropdown-item" href="{{ route('admin.profile') }}"> <svg class="icon me-2">
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
        @yield('header')
      </header>