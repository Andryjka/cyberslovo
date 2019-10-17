<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CYBERSLOVO ADMINPANEL</title>
    <!-- Icons-->
    <link href="{{asset('node_modules/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('node_modules/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('node_modules/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('node_modules/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('admin_template/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/css/select2.min.css')}}" rel="stylesheet">
    <style>
      .form-control::-webkit-input-placeholder {color:#adb0b3; opacity:1;}/* webkit */
      .form-control::-moz-placeholder          {color:#adb0b3; opacity:1;}/* Firefox 19+ */
      .form-control:-moz-placeholder           {color:#adb0b3; opacity:1;}/* Firefox 18- */
      .form-control:-ms-input-placeholder      {color:#adb0b3; opacity:1;}/* IE */
    </style>


</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar navbar-expand-lg">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/cyberpunk">
        CYBERSLOVO
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
      </ul>
      <ul class="nav navbar-nav ml-auto pr-4">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <b>{{ Auth::user()->name }} &laquo;{{ Auth::user()->username }}&raquo; {{ Auth::user()->surname }}</b>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('user.profile', Auth::user())}}"><i class="fa fa-user" aria-hidden="true"></i>
 Изменить профиль</a>
             <a class="dropdown-item" href="{{route('user_password.edit', Auth::user())}}"><i class="fa fa-key" aria-hidden="true"></i>
 Изменить пароль</a>
             <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                      <i class="fa fa-lock"></i>
                                        {{ __('Выйти из системы') }}
             </a>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
          </form>
        </li>
      </ul>
    </header>

    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="/">
                <i class="nav-icon icon-speedometer"></i> Панель управления
              </a>
            </li>
            <li class="nav-title">Публикации</li>
            <li class="nav-item">
              <a class="nav-link" href="/cyberpunk/article">
                <i class="nav-icon icon-pencil"></i> Материалы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cyberpunk/category">
                    <i class="nav-icon icon-note"></i> Категории </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cyberpunk/insiders">
                  <i class="nav-icon icon-info"></i> Инсайды</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cyberpunk/tags">
                  <i class="nav-icon icon-tag"></i> Теги</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cyberpunk/today">
                  <i class="nav-icon icon-info"></i> #ВКУРСЕ</a>
            </li>
            <li class="nav-title">Пользователи и группы</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                  <i class="nav-icon icon-user"></i> Пользователи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                  <i class="nav-icon icon-group"></i> Группы</a>
            </li>
          </ul>
        </nav>
      </div>

    <main class="main pt-4">
        <div class="container">
            <div class="row">
                 @yield('content')
            </div>
        </div>   
    </main>

 <script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
  <!--    <script src="{{asset('node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{asset('node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script> -->
    <script src="{{asset('node_modules/pace-progress/pace.min.js')}}"></script>
    <script src="{{asset('node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('node_modules/@coreui/coreui/dist/js/coreui.min.js')}}"></script>
    <!-- Plugins and scripts required by this view-->
    <!-- <script src="{{asset('node_modules/chart.js/dist/Chart.min.js')}}"></script> -->
    <script src="{{asset('node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js')}}"></script>
    <script src="{{asset('/admin_template/js/main.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/7i51jw4i37n4xfqk7dax6flunh299ln0elzdie3yrfystlr8/tinymce/4/tinymce.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/tinymce.js')}}"></script>
    <script src="{{asset('js/ru.js')}}"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>

    @yield('admin-footer')
</body>
</html>
