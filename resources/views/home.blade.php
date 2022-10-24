<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Recording Telur Ayam</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/dist/img/LogoKWT.png') }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- PWA  -->
    <meta name="theme-color" content="white"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo"><a href="index.html"></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#tentang">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#produk">Produk</a></li>
          <li><a class="nav-link scrollto " href="#galeri">Galeri</a></li>
          @auth
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ Auth::user()->name }}</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a></li>
              <li><a href="{{ route('logout') }}" class="dropdown-item">Logout</a></li>
            </ul>
        </li>  
          @else
          <li><a class="nav-link scrollto" href="{{ route('login')}}"> Login</a></li>
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>Kelompok Wanita Tani “Kembang Wono”</h1>
      <h2>Desa Tirtomulyo, Kecamatan Plantungan, Kabupakten Kendal</h2>
      @auth
      <h2>Hi, {{ Auth::user()->name }}</h2>
      @else
      <a href="{{ route('login')}}" class="btn-get-started scrollto">LOGIN</a>
      @endauth
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="tentang" class="about">
      <div class="container">

        <div class="section-title">
            <h2>Tentang</h2>
          <h3>KWT<span> Kembang Wono</span></h3>
        </div>

        <div class="row content">
          <div class="col-lg-12">
            <p>
                Potensi utama Desa Tirtomulyo yaitu peternakan dan pertanian yang salah satunya dikembangkan oleh kelompok wanita tani “Kembang Wono”.
                Saat ini, bersama dengan Tim Bina Desa BEM FPP Universitas Diponegoro 
                sedang mengembangkan konsep agroeduwisata daring yaitu barcode tani dan ternak “BARTANDER”.
                Selain itu  kelompok wanita tani “Kembang Wono” juga memiliki usaha unggulan yaitu produksi telur ayam arab "Endog Wonokambang" dan bolu jangung manis "Bujang ManisKU"
            </p>
            <ul>
              Kagiatan Kelompok Wanita Tani “Kembang Wono” :
              <li><i class="ri-check-line"></i> Pertemuan rutin setiap bulan</li>
              <li><i class="ri-check-line"></i> Gerakan Kegiatan Pekarangan Pangan Lestari (KPPL)</li>
              <li><i class="ri-check-line"></i> Melakukan Recording ayam arab setiap hari</li>
              <li><i class="ri-check-line"></i> Grading telur ayam arab bersama anggota</li>
              <li><i class="ri-check-line"></i> Memproduksi bolu jangung manis "Bujang ManisKU" </li>
              <li><i class="ri-check-line"></i> Pemasaran produk telur "Endog Wonokambang" dan bolu "Bujang ManisKU"</li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

     <!-- ======= Team Section ======= -->
     <section id="produk" class="team">
        <div class="container">
  
          <div class="section-title">
            <h2>Produk </h2>
            <h3>Produk Ungulan<span> KWT Kembang Wono</span></h3>
            <p>Semua produk dapat di beli dengan sistem PO (Pre-Order) terlebih dahulu. Kami menerima pesanan baik secara langsung maupun online.</p>
          </div>
  
          <div class="row">
  
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <div class="member-img">
                  <img src="assets/img/telur.jpg" style="width:350px;height:350px;" class="img-fluid" alt="">
                </div>
                <div class="member-info py-1">
                  <h4>Endog Wonokambang</h4>
                  <span><p>100% Telur Ayam Arab</p>
                  <p>Grade 1: Rp. 9000/pack isi 3 butir 
                    Grade 2: Rp. 7500/pack isi 3 butir</p>
                </span>
                </div>
                <div class="member-info py-1">
                    <a href="//api.whatsapp.com/send?phone=+6282327600302&text=Hallo, Saya mau pesan.." class="btn btn-success">Pesan</a>
                </div>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <div class="member-img">
                  <img src="assets/img/bolu.jpg" style="width:350px;height:350px;" class="img-fluid" alt="">
                </div>
                <div class="member-info py-1">
                  <h4>Bujang ManisKU</h4>
                  <span><p>jagung manis 100% dari petani lokal</p>
                  <p>Harga : Rp. 30.000/pack, 
                    Varian Rasa: Coklat, Keju, Oreo, Mix (2 toping)</p>
                </span>
                </div>
                <div class="member-info py-1">
                    <a href="//api.whatsapp.com/send?phone=+6282327600302&text=Hallo, Saya mau pesan.." class="btn btn-success">Pesan</a>
                </div>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <div class="member-img">
                  <img src="assets/img/ricarica.jpg" class="img-fluid" style="width:350px;height:350px;" alt="">
                </div>
                <div class="member-info py-1">
                  <h4>Rica - Rica Ayam Arab</h4>
                  <span><p>70.000/Ekor</p>
                <p></p>
                  <p>Level pedas bisa request sesuai selera</p>
                </span>
                </div>
                <div class="member-info">
                    <a href="//api.whatsapp.com/send?phone=+6282327600302&text=Hallo, Saya mau pesan.." class="btn btn-success">Pesan</a>
                </div>
              </div>
            </div>
  
          </div>
  
        </div>
      </section><!-- End Team Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="galeri" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>GALERY</h2>
          <h3>Galeri kegiatan kelompok wanita tani “Kembang Wono”</h3>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/vaksinasi-ayam.jpg" class="img-fluid" style="height:300px;"  alt="">
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/kandang-kwt.jpg" class="img-fluid"  style="height:300px;" alt="">
          </div>
          
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/grading-telur.png" class="img-fluid" style="height:300px;"  alt="">
          </div>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12 center footer-contact">
              <div class="card card-5">
                  <div class="card-body">
                    <img src="{{ asset('assets/dist/img/LogoUNDIP.png') }}" class="mx-auto d-block" width="100px" height="120px"/><br>
                    <h6 class="text text-center">Pengembangan Aplikasi Recording Telur Ayam Berbasis Web pada Kelompok Wanita Tani “Kembang Wono” </h6><br>
                    <h6 class="text text-center">
                      <strong>Puput Werdiningsih /  21120118120012</strong><br>
                    </h6><br>
                    <h6  class="text text-center">Departement Teknik Komputer</h6>
                    <h6  class="text text-center">Universitas Diponegoro</h6>
                    <h6  class="text text-center">2022</h6>
                  </div>
              </div>
             
          </div>
          
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-3">
      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>KWT Kembang Wono</span></strong>. All Rights Reserved
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  {{-- PWA --}}
  <script src="{{ asset('/sw.js') }}"></script>
  <script>
      if (!navigator.serviceWorker.controller) {
          navigator.serviceWorker.register("/sw.js").then(function (reg) {
              console.log("Service worker has been registered for scope: " + reg.scope);
          });
      }
  </script>

</body>

</html>