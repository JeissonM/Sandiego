<!DOCTYPE HTML>
<html>

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <link href="{{asset('plugins/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!-- chart -->
    <script src="{{ asset('js/Chart.js') }}"></script>
    <!-- //chart -->
    <!--Calender-->
    <link rel="stylesheet" href="{{ asset('css/clndr.css') }}" type="text/css" />
    <script src="{{ asset('js/underscore-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/moment-2.2.1.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/clndr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/site.js') }}" type="text/javascript"></script>
    <!--End Calender-->
    <!-- Metis Menu -->
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push" id="body">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
                <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                    <ul class="nav" id="side-menu">
                        @if(session()->exists('MOD_INICIO'))
                        @if($location=='home')
                        <li class="active"><a class="active" href="{{route('inicio')}}"><i class="fa fa-home nav_icon"></i> <span>Inicio</span></a>
                        </li>
                        @else
                        <li><a href="{{route('inicio')}}"><i class="fa fa-home nav_icon"></i> <span>Inicio</span></a></li>
                        @endif
                        @endif
                        @if(session()->exists('MOD_USUARIOS'))
                        @if($location=='usuarios')
                        <li class="active"><a class="active" href="{{route('menu.usuarios')}}"><i class="fa fa-users nav_icon"></i> <span>Usuarios</span></a>
                        </li>
                        @else
                        <li><a href="{{route('menu.usuarios')}}"><i class="fa fa-users nav_icon"></i> <span>Usuarios</span></a></li>
                        @endif
                        @endif
                        @if(session()->exists('MOD_DATOS-BASICOS'))
                        @if($location=='datos-basicos')
                        <li class="active"><a class="active" href="{{route('menu.datos_basicos')}}"><i class="fa fa-file nav_icon"></i> <span>Datos Generales</span></a>
                        </li>
                        @else
                        <li><a href="{{route('menu.datos_basicos')}}"><i class="fa fa-file nav_icon"></i> <span>Datos Generales</span></a></li>
                        @endif
                        @endif
                        @if(session()->exists('MOD_PERSONAL'))
                        @if($location=='personal')
                        <li class="active"><a class="active" href="{{route('menu.personal')}}"><i class="fa fa-user nav_icon"></i> <span>Personal de la Institución</span></a>
                        </li>
                        @else
                        <li><a href="{{route('menu.personal')}}"><i class="fa fa-user nav_icon"></i> <span>Personal de la Institución</span></a></li>
                        @endif
                        @endif
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out nav_icon"></i>Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    <!-- //sidebar-collapse -->
                </nav>
            </div>
        </div>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <div class="sticky-header header-section ">
            <div class="header-left">
                <!--toggle button start-->
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                <!--toggle button end-->
                <!--logo -->
                <div class="logo">
                    <a href="{{route('inicio')}}">
                        <h1>{{ config('app.name') }}</h1>
                        <span>AdminPanel</span>
                    </a>
                </div>
                <!--//logo-->
                <!--search-box
                <div class="search-box">
                    <form class="input">
                        <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
                        <label class="input__label" for="input-31">
                            <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
                            </svg>
                        </label>
                    </form>
                </div>
                end-search-box-->
                <div class="clearfix"> </div>
            </div>
            <div class="header-right">
                <div class="profile_details_left">
                    <!--notifications of menu start -->
                    <ul class="nofitications-dropdown">
                        <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have 3 new messages</h3>
                                    </div>
                                </li>
                                <li><a href="#">
                                        <div class="user_img"><img src="{{ asset('images/1.png') }}" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Lorem ipsum dolor amet</p>
                                            <p><span>1 hour ago</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a></li>
                                <li class="odd"><a href="#">
                                        <div class="user_img"><img src="{{ asset('images/2.png') }}" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Lorem ipsum dolor amet </p>
                                            <p><span>1 hour ago</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="user_img"><img src="{{ asset('images/3.png') }}" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Lorem ipsum dolor amet </p>
                                            <p><span>1 hour ago</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a></li>
                                <li>
                                    <div class="notification_bottom">
                                        <a href="#">See all messages</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have 3 new notification</h3>
                                    </div>
                                </li>
                                <li><a href="#">
                                        <div class="user_img"><img src="{{ asset('images/2.png') }}" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Lorem ipsum dolor amet</p>
                                            <p><span>1 hour ago</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a></li>
                                <li class="odd"><a href="#">
                                        <div class="user_img"><img src="{{ asset('images/1.png') }}" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Lorem ipsum dolor amet </p>
                                            <p><span>1 hour ago</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="user_img"><img src="{{ asset('images/3.png') }}" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Lorem ipsum dolor amet </p>
                                            <p><span>1 hour ago</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a></li>
                                <li>
                                    <div class="notification_bottom">
                                        <a href="#">See all notifications</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">15</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have 8 pending task</h3>
                                    </div>
                                </li>
                                <li><a href="#">
                                        <div class="task-info">
                                            <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="bar yellow" style="width:40%;"></div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="task-info">
                                            <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="bar green" style="width:90%;"></div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="task-info">
                                            <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="bar red" style="width: 33%;"></div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="task-info">
                                            <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="bar  blue" style="width: 80%;"></div>
                                        </div>
                                    </a></li>
                                <li>
                                    <div class="notification_bottom">
                                        <a href="#">See all pending tasks</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <!--notification menu end -->
                <div class="profile_details">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img"><img src="{{ asset('images/avatar.jpg') }}" alt=""> </span>
                                    <div class="user-name">
                                        <p>{{Auth::user()->nombres}}</p>
                                        <span>{{session('ROL')}}</span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li> <a href="#"><i class="fa fa-user"></i> Perfil</a> </li>
                                <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form2').submit();">
                                        <i class="fa fa-sign-out nav_icon"></i>Salir
                                    </a>
                                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
                @include('flash::message')
                @yield('content')
                <div class="clearfix"> </div>
            </div>
        </div>
        <!--footer-->
        <div class="footer">
            <p>&copy; 2020 {{ config('app.name') }}. Todos los derechos reservados</p>
        </div>
        <!--//footer-->
    </div>
    <!-- Classie -->
    <script src="{{ asset('js/classie.js') }}"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };


        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!--scrolling js-->
    <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.js') }}"> </script>
    <!-- DataTables -->
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/pnotify/dist/pnotify.js')}}"></script>
    <script src="{{ asset('plugins/pnotify/dist/pnotify.buttons.js')}}"></script>
    <script src="{{ asset('plugins/pnotify/dist/pnotify.nonblock.js')}}"></script>
    <script type="text/javascript">
        var url = "<?php echo config('app.url'); ?>";

        function notify(title, text, type) {
            new PNotify({
                title: title,
                text: text,
                type: type,
                styling: 'bootstrap3'
            });
        }
    </script>
    @yield('script')
</body>

</html>