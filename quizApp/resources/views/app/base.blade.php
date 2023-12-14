<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}" />
    <!-- color css -->
    <link rel="stylesheet" href="{{ url('assets/css/colors.css') }}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-select.css') }}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ url('assets/css/perfect-scrollbar.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ url('assets/css/custom.css') }}" />
    <!-- Incluye Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive" src="{{ url('assets/images/layout_img/user_img.jpg') }}" alt="#" /></div>
                            <div class="user_info">
                                @auth
                                <h6>{{ Auth::user()->name }}</h6> <!-- Muestra el nombre del usuario -->
                                @else
                                <h6>Unidentified</h6>
                                @endauth
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>General</h4>
                    @auth
                    <ul class="list-unstyled components">
                        <li><a href="{{ url('') }}"><i class="fa fa-solid fa-desktop"></i> <span>Dashboard</span></a>
                        <li><a href="{{ url('quizz') }}"><i class="fa fa-duotone fa-gamepad yellow_color"></i> <span>Play</span></a>
                        <li class="active">
                            <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-solid fa-question blue1_color"></i> <span>Questions</span></a>
                            <ul class="collapse list-unstyled" id="dashboard">
                                <li>
                                    <a href="{{ url('question') }}"> <span>View questions</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('question/create') }}"> <span>Create Question</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ url('record') }}"><i class="fa fa-solid fa-bars orange_color"></i> <span>Record</span></a>
                        </li>
                        <li><a id="logout-link" href="#"><i class="fa fa-sign-out"></i><span>Log Out</span></a>
                        </li>

                    </ul>
                    @else
                    <ul class="list-unstyled components">
                        <li><a href="{{ url('login') }}"><i class="fa fa-solid fa-user yellow_color"></i><span>Login</span></a></li>
                        <li><a href="{{ url('register') }}"><i class="fa fa-solid fa-user-plus blue1_color"></i><span>Register</span></a>
                    </ul>
                    @endauth
                </div>
            </nav>

            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{ url('assets/images/layout_img/user_img.jpg') }}" alt="#" /><span class="name_user">@auth
                                                    {{ Auth::user()->name }}
                                                    @else
                                                    Unidentified
                                                    @endauth</span></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" id="logout-link" href="#">
                                                    <span>Log Out</span> <i class="fa fa-sign-out"></i>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                @if(session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
                @endif
                <br>
                <br>
                @yield('content')
                <!-- footer -->
                <div class="container-fluid">
                    <div class="footer">
                        <p>Copyright © 2023 Designed by Alejandro. All rights reserved.<br><br>
                        </p>
                    </div>
                </div>
            </div>
            <!-- end dashboard inner -->
        </div>
    </div>
    <!-- Script para manejar el clic en el enlace -->
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el enlace realice la navegación
            document.getElementById('logout-form').submit(); // Enviar el formulario
        });
    </script>
    <!-- jQuery -->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <!-- wow animation -->
    <script src="{{ url('assets/js/animate.js') }}"></script>
    <!-- select country -->
    <script src="{{ url('assets/js/bootstrap-select.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ url('assets/js/owl.carousel.js') }}"></script>
    <!-- chart js -->
    <script src="{{ url('assets/js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/js/Chart.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/utils.js') }}"></script>
    <script src="{{ url('assets/js/analyser.js') }}"></script>
    <!-- nice scrollbar -->
    <script src="{{ url('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="{{ url('assets/js/chart_custom_style1.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>

    <!-- Incluye Bootstrap JavaScript y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Incluye Bootstrap Bundle (JS y Popper.js incluidos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>