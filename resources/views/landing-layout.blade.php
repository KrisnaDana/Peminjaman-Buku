<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="icon" href="{{url('/assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{url('/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{url('/assets/css/argon.css?v=1.2.0')}}" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <title>@yield('title')</title>

</head>

<body class="bg-default g-sidenav-show g-sidenav-pinned">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h6 class="h2 text-white d-inline-block mb-0"><strong>PINJAM BUKU</strong></h6>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav align-items-lg-right ml-lg-auto">
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="nav-link">
                            <span class="nav-link-inner--text">Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('register')}}" class="nav-link">
                            <span class="nav-link-inner--text">Register</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Peminjaman Buku</h1>
                            <p class="text-lead text-white">Buku merupakan jendela ilmu. Membaca buku merupakan hal yang penting. Website ini menyediakan peminjaman berbagai jenis buku</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        @yield('body')
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; 2021 <a href="javascript:void(0)" class="font-weight-bold ml-1">Kelompok 17</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">Kelompok 17</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{url('/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('/assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{url('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{url('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{url('/assets/js/argon.js?v=1.2.0')}}"></script>
    <div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>


</body>

</html>