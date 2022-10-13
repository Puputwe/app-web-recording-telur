<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<nav class="main-header navbar navbar-expand-md navbar-light navbar-olive">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('assets/dist/img/LogoKWT.png') }}" alt="KWT Logo" class="brand-image bg-white img-circle elevation-1" style="opacity: .9">
            <span class="brand-text text-white font-weight-bold h7">Recording Ayam</span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-white">Recording</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('produksiTelur') }}" class="dropdown-item">Telur</a></li>
              <li><a href="{{ route('create.performa') }}" class="dropdown-item">Performa</a></li>
              </ul>
          </li> 
          <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-white">Laporan</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('laporanPerforma') }}" class="dropdown-item">Catatan Harian</a></li>
              <li><a href="{{ route('laporanGrafik') }}" class="dropdown-item">Grafik</a></li>
              </ul>
          </li>  
        </ul>


        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-white"><span class="hidden-xs text-white">{{ Auth::user()->name }}</span></a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="{{ route('logout') }}" class="dropdown-item">Logout</a></li>
                  </ul>
              </li>
          </li>
        </ul>
      </nav>
    