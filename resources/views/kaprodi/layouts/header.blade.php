<header class="header header-sticky p-0 mb-4">
    <div class="container-fluid px-4 border-bottom">
        <button class="header-toggler" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
            style="margin-inline-start: -14px">
            <svg class="icon icon-lg">
                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button>
        {{-- <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#" data-coreui-i18n="settings">Settings</a></li>
          </ul> --}}
          <ul class="header-nav d-none d-md-flex ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-lg my-1 mx-2">
                  <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg>
                @if(auth()->user()->unreadNotifications->count() > 0)
                  <span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient">
                    {{ auth()->user()->unreadNotifications->count() }}
                  </span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">
                  Notifikasi
                </div>
                
                <div style="width: 500px; max-height: 300px; overflow-y: auto;">
                    @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                    <a class="dropdown-item" href="{{ $notification->data['action_url'] }}">
                        <div class="message text-wrap {{ $notification->read_at ? '' : 'fw-bold' }}">
                          <div class="d-flex align-items-center">
                            <div class="me-2">
                              @if(isset($notification->data['type']) && $notification->data['type'] == 'message')
                                <svg class="icon text-primary"><use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use></svg>
                              @elseif(isset($notification->data['type']) && $notification->data['type'] == 'alert')
                                <svg class="icon text-danger"><use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-warning"></use></svg>
                              @else
                                <svg class="icon text-info"><use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-info"></use></svg>
                              @endif
                            </div>
                            <div class="flex-grow-1">
                              <div class="d-flex justify-content-between">
                                <div>{{ $notification->data['title'] }}</div>
                                <div class="small text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
                              </div>
                              <div class="small text-muted">{{ $notification->data['message'] }}</div>
                            </div>
                          </div>
                        </div>
                      </a>
                    @empty
                      <div class="dropdown-item text-center">Tidak ada notifikasi</div>
                    @endforelse
                  </div>
                
                @if(auth()->user()->notifications->count() > 5)
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-center fw-semibold" href="{{ route('notifications.index') }}">Lihat semua notifikasi</a>
                @endif
              </div>
            </li>
            
          </ul>
        <ul class="header-nav ms-auto ms-md-0">
            <li class="nav-item py-1">
                <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>

            <li class="nav-item dropdown">
                <button class="btn btn-link nav-link" type="button" aria-expanded="false"
                    data-coreui-toggle="dropdown">
                    <svg class="icon icon-lg theme-icon-active">
                        <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-contrast">
                        </use>
                    </svg>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                    <li>
                        <button class="dropdown-item d-flex align-items-center" type="button"
                            data-coreui-theme-value="light">
                            <svg class="icon icon-lg me-3">
                                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-sun">
                                </use>
                            </svg><span data-coreui-i18n="light">Light</span>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center" type="button"
                            data-coreui-theme-value="dark">
                            <svg class="icon icon-lg me-3">
                                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-moon">
                                </use>
                            </svg><span data-coreui-i18n="dark"> Dark</span>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center active" type="button"
                            data-coreui-theme-value="auto">
                            <svg class="icon icon-lg me-3">
                                <use
                                    xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-contrast">
                                </use>
                            </svg>Auto
                        </button>
                    </li>
                </ul>
            </li>
            <li class="nav-item py-1">
                <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        @if ($user->profile)
                            <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile"
                                class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                        @else
                            <i class="fas fa-user-circle fa-3x text-secondary"></i>
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">

                    <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2"
                        data-coreui-i18n="settings">Settings</div><a class="dropdown-item" href="#">
                        <a class="dropdown-item" href="{{ route('profile', ['role' => 'kaprodi']) }}"> <svg
                                class="icon me-2">
                                <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-user">
                                </use>
                            </svg><span data-coreui-i18n="profile">Profile</span></a>

                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-account-logout">
                                    </use>
                                </svg>
                                Logout
                            </a>

                </div>
            </li>
        </ul>

    </div>

    @yield('header')

</header>
