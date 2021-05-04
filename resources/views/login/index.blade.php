<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/asset/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/asset/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Mediatama</b>&nbsp;WEB
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Login Untuk Masuk Ke Sistem</p>

      <form action="{{route('login-admin')}}" method="post">
        @csrf
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </div>
      </form>
  </div>
</div>
    
<!-- jQuery -->
<script src="{{asset('/asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/asset/dist/js/adminlte.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#username').val('')
        $('#password').val('')
    })
</script>
</body>
</html>