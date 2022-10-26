<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Login </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="shrotcut icon" href="{{ asset('assets/dist/img/LogoKWT.png') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
  
    @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"> ×</button>	
        <strong>{{ $message }}</strong>
      </div>
    @endif
    @if ($message = Session::get('warwar'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert"> ×</button>	
        <strong>{{ $message }}</strong>
      </div>
    @endif
  
  <div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-olive">
    <div class="card-header text-center">
      <img src="{{ asset('assets/dist/img/LogoKWT.png') }}" class="mx-auto d-block" width="100px" height="100px"/>
      <a href="{{ asset('#') }}" class="h3 text-olive"><b>KWT KEMBANG WONO</b></a>
      <p class="h6 text-olive"><i>Recording Ayam Arab</i></p>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masuk Menggunakan Akun Anda</p>

      <form action="{{ route('postlogin') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              </div>
              </div>
          <!-- /.col -->
          <div class="col-4 mb-3">
            <button type="submit" class="btn btn-success btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
        <div>
          <p class="mb-0"> Belum punya akun ?
            <a href="{{route('register')}}" class="text-center">Daftar Sekarang</a>
            </p>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  @include('sweetalert::alert')
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
