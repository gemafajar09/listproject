<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Mediatama Web</title>

 @include('template.header')
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
@include('template.script')
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-light navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" style="cursor:pointer" onclick="logout()" role="button">Keluar&nbsp;<i class="fas fa-sign-out-alt"></i></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li> -->
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-light-info elevation-4">
    <a href="/back/home" class="brand-link">
      <img src="{{asset('/asset/dist/img/AdminLTELogo.png')}}" alt="Foto" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Administrator</span>
    </a>

    <div class="sidebar">

    @include('template.navbar')
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark">Starter Page</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Option</h5>
      <ul>
        <li class="nav-link">
          <a href="">Logout</a>
        </li>
        <li class="nav-link">
          <a href="">Logout</a>
        </li>
      </ul>
    </div>
  </aside>

  @include('template.footer')
</div>

</body>
</html>
