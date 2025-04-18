<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
  <div class="sidebar-header border-bottom">
    <div class="sidebar-brand">
      <img src="{{ asset('template') }}/assets/brand/Logo.svg" width="200" height="65" alt="Logo HaloSurat">

    </div>
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
