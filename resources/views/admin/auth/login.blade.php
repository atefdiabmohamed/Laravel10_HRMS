<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/admin/fonts/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css') }}">
</head>
<style>
input.form-control {
    text-align: right;
}
p {
    text-align: right;
}
</style>
<body class="hold-transition login-page" style="background-size: cover; background-image: url('{{ asset('assets/admin/imgs/login.jpg') }}')">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>HR</b>MS</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
 


      <p class="login-box-msg">تسجيل الدخول</p>

      <form action="{{ route('admin.login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="اسم المستخدم" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('username')
        <p class="text-danger">   {{ $message }}</p>
          
        @enderror

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        @error('password')
        <p class="text-danger">   {{ $message }}</p>
          
        @enderror
        <div class="row">
        
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">دخول </button>
            </div>
            <!-- /.col -->
          </div>
      </form>


    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
