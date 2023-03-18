<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Koora Zoone</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}



    <style>
    * {
        font-family: 'Tajawal', sans-serif;
    }
    </style>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header dir="ltr" class="app-header"><a class="app-header__logo" href="{{-- route('admin.index') --}}">Koora Zoone</a>
      
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar" dir="ltr"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user" style="display: block; margin-left: auto; margin-right: auto; width: 70% ;">

            <!-- <div>
                <p class="app-sidebar__user-name">{{ Auth::user()->name ?? 'Not User' }}</p>
                <p class="app-sidebar__user-designation">{{ Auth::user()->email ?? 'Not User' }}</p>
            </div> -->
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item"  href="{{ route('dashboard.index') }}"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">لوحة
                        التحكم</span></a></li>
            <li><a class="app-menu__item {{ Request::is('*/glob-teams') ? "active" : '' }} " href="{{ route('glob-teams.index') }}"><i
                        class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">الفرق العالمية</span></a>
            </li>
            <li><a class="app-menu__item {{ Request::is('*/locl-teams') ? "active" : '' }}" href="{{ route('locl-teams.index') }}"><i
                class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">الفرق المحلية</span></a>
             </li>
           
            <li><a class="app-menu__item {{ Request::is('*/natio-teams') ? "active" : '' }}" href="{{ route('natio-teams.index') }}"><i
                        class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">المنتخبات</span></a>
            </li>
           
            <li><a class="app-menu__item {{ Request::is('*/posts') ? "active" : '' }}" href="{{ route('posts.index') }}"><i
                class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">الأخبار المنشورة</span></a>
             </li>

             <li><a class="app-menu__item {{ Request::is('*/general-team') ? "active" : '' }}" href="{{ route('general-chat') }}"><i
                class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">الشات العام </span></a>
             </li>

            <li><a class="app-menu__item {{ Request::is('*/suggests-team') ? "active" : '' }}" href="{{ route('suggests-team.index') }}"><i
                        class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">
                        الفرق المقترحة</span></a></li>
            <li><a class="app-menu__item {{ Request::is('*/reals') ? "active" : '' }}" href="{{ route('reals.index') }}"><i
                            class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">
                            الريلز </span></a></li>
            <li><a class="app-menu__item" href="{{ route('users.index') }}"><i
                        class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">المستخدمين</span></a>
            </li>

            <li><a class="app-menu__item" href="{{ route('flags.index') }}"><i
                class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">البلاغات</span></a>
            </li>


            <li><a id="logout" class="app-menu__item" ><i
                class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">تسجيل الخروج</span></a>
            </li>


            <form id="form" action={{ route('admin.logout') }} method="POST">
                @csrf
            </form>

            {{-- <li><a class="app-menu__item" href="{{ route('emergency.index') }}"><i
                        class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">حالة طارئة</span></a>
            </li>  --}}




        </ul>
    </aside>
    <main class="app-content">
        @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ asset('js/plugins/chart.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"  ></script>
   
    @yield('scripts')

    <script>
        $('#logout').click(function() {
              $('#form').submit();
          });
  </script>
</body>

</html>
