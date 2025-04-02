<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
      <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
          <svg class="sidebar-brand-full" width="110" height="32" alt="Logo HaloSurat">
            <use xlink:href="{{ asset('template') }}/assets/brand/Logo.svg#full"></use>
          </svg>
          <svg class="sidebar-brand-narrow" width="32" height="32" alt="Logo HaloSurat">
            <use xlink:href="{{ asset('template') }}/assets/brand/Logo.svg#signet"></use>
          </svg>
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close"></button>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
            <svg class="nav-icon">
              <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg><span data-coreui-i18n="dashboard">Dashboard</span></a></li>
        {{-- <li class="nav-title" data-coreui-i18n="theme">Admin</li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('tu.mahasiswa') }}">
            <svg class="nav-icon">
              <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-drop"></use> --}}
            {{-- </svg><span data-coreui-i18n="colors">Mahasiswa</span></a></li> --}}
        <li class="nav-item"><a class="nav-link" href="{{ route('tu.pengajuan.show') }}">
            <svg class="nav-icon">
              <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
            </svg><span data-coreui-i18n="typography">Daftar Surat</span></a></li>
       {{-- <li class="nav-item"><a class="nav-link" href="{{ route('tu.pengajuan') }}">
         <svg class="nav-icon">
           <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
         </svg><span data-coreui-i18n="colors">Mata kuliah</span></a></li> --}}
      </ul>
        
      <div class="sidebar-footer border-top d-none d-lg-flex">
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
      </div>
    </div>
<<<<<<< Updated upstream
    
=======
    <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close"></button>
  </div>
  <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
    <li class="nav-item"><a class="nav-link" href="{{ route('tu.dashboard') }}">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
        </svg><span data-coreui-i18n="dashboard">Dashboard</span></a></li>
    <li class="nav-title" data-coreui-i18n="theme">TU</li>
   
    <li class="nav-item"><a class="nav-link" href="{{ route('tu.pengajuan') }}">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
        </svg><span data-coreui-i18n="typography">Daftar Pengajuan</span></a></li>

    
    
    

    
  <div class="sidebar-footer border-top d-none d-lg-flex">
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>
</div>
>>>>>>> Stashed changes
