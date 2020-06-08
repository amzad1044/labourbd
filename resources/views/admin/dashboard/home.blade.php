<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{asset('admin/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" id="app">

  <header-section></header-section>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/img_upload/users/{{ Auth::user()->photo }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>


        <li>
          <router-link to="/main">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </router-link>
        </li>

        <li>
          <router-link to="/type">
            <i class="fa fa-book"></i> <span>Type</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow" id="typecount"></small>
            </span>
            </router-link>
        </li>

        <li>
          <router-link to="/area">
            <i class="fa fa-flag-checkered"></i> <span>Area</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow" id="areacount"></small>
            </span>
          </router-link>
        </li>
        <li>
          <router-link to="/labour">
            <i class="fa fa-user-plus"></i> <span>Labour</span>
          </router-link>
        </li>

        <li>
          <router-link to="/onworking">
            <i class="fa fa-gear"></i> <span>Working Request</span>
          </router-link>
        </li>

        <li class="header">Others</li>
        <li>
          <router-link to="/profile">
            <i class="fa fa-circle-o text-red"></i> <span>Profile</span>
          </router-link>
        </li>
        <li>
          <a href="{{route('register')}}">
            <i class="fa fa-circle-o text-yellow"></i> <span>Create Profile</span>
          </a>
        </li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> 
            <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
              <app/>
    </section>

  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <a href="https://www.facebook.com/amzad1044"><span><i class="fa fa-facebook-official"></i>Gracious</span></a>
    </div>
    <strong>Copyright<span id="date"></span>

    </strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>

</div>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<script src="{{asset('admin/js/jquery-2.2.3.min.js')}}"></script>

<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>

<script src="{{asset('admin/js/app.min.js')}}"></script>
<script>
  const x = new Date().getFullYear();
  let date = document.getElementById('date');
  date.innerHTML = '&copy; ' + x + date.innerHTML;
</script>

<script type="text/javascript">
  var url = '{{url('fatchType')}}';
  $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': '{{csrf_token()}}'}
    
  });
  function getall(){
    $.get(url)
      .success(function (data){
        document.getElementById("typecount").innerHTML = data;
      })
  }
  getall();

  var url = '{{url('fatchArea')}}';

  function getallArea(){
    $.get(url)
      .success(function (data){
        document.getElementById("areacount").innerHTML = data;
      })
  }
  getallArea();
</script>

</body>
</html>
