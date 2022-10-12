<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-olive elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link navbar-olive">
    <img src="{{ asset('assets/dist/img/LogoKWT.png') }}" alt="KWT Logo" class="brand-image bg-white img-circle elevation-1" style="opacity: .9">
    <span class="brand-text text-white font-weight-bold h7">Recording Ayam</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{ route('dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Main</li>
        <li class="nav-item">
          <a href="{{ route('kandang') }}" class="nav-link">
            <i class="nav-icon fas fa-cubes"></i>
            <p>Kandang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('produksi') }}" class="nav-link">
            <i class="nav-icon fas fa-mobile"></i>
            <p>Produksi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Recording
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('recording') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Catatan Harian</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('grafik') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Grafik</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-laptop"></i>
            <p>
              Data Master
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            {{-- <li class="nav-item">
              <a href="{{ route('populasi') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Populasi</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{ route('pakan') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Pakan</p>
              </a>
            </li>
          <li class="nav-item">
          <a href="{{ route('stok-pakan') }}" class="nav-link">
            <i class="far nav-icon"></i>
            <p>Stok Pakan</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="{{ route('role') }}" class="nav-link">
            <i class="far nav-icon"></i>
            <p>Role</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="{{ route('user') }}" class="nav-link">
            <i class="far nav-icon"></i>
            <p>User</p>
          </a>
        </li>
      </ul>
    </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-trash"></i>
            <p>
              Trash
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('user_trash') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Data User</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('kandang_trash') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Data Kandang</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('populasi_trash') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Data Populasi</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('produksi_trash') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Data Produksi</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('pakan_trash') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Data Pakan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('stok_trash') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Data Stok Pakan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('recording_trash') }}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Data Recording</p>
              </a>
            </li>
          </ul>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
         
