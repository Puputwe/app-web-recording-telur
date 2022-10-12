<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Register </title>

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
  
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-olive">
    <div class="card-header text-center">
      <img src="{{ asset('assets/dist/img/LogoKWT.png') }}" class="mx-auto d-block" width="100px" height="100px"/>
      <a href="{{ asset('#') }}" class="h3 text-olive"><b>KWT KEMBANG WONO</b></a>
      <p class="h6 text-olive">Daftar Akun</p>
    </div>
    <div class="card-body">
      <form action="{{ route('postregister') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Nama lengkap" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
          <input type="email" value="{{ old('email') }}" class="form-control" name="email" placeholder="nama@email.com" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div>
          @error('email')
          <p class="text-danger">{{ $message }}</p>
         @enderror
        </div>
        <div class="input-group mb-3">
          <select name="role_id" class="form-control" id="role_id" required>
            <option value="" @if (old('role_id')=='' or old('role_id')==0) selected="selected" @endif>Pilih Role</option>
          @foreach ($role as $e)
              <option value="{{$e->id}}">{{$e->role}}</option>
          @endforeach
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
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
          @error('password')
          <div class="text-danger">{{ $message }}</div>
         @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Retype Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
              <div class="text-danger">{{ $message }}</div>
             @enderror
          </div>
          <div class="row">
            <div class="col-8">
                <p class="mb-0"> Sudah punya akun ?
                    <a href="{{route('login')}}" class="text-center">Login</a>
                    </p>
            </div>
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block btn-login">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
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
