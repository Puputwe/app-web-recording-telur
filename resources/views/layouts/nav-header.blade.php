<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-olive navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="text-white fas fa-bars"></i></a>
    </li>
  </ul>
</li>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-white"><i class="fa fa-user"></i> <span class="hidden-xs text-white">{{ Auth::user()->name }}</span></a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="{{ route('logout') }}" class="dropdown-item">Logout</a></li>
            </ul>
        </li>
    </li>
  </ul>
</nav>
<!-- /.navbar -->