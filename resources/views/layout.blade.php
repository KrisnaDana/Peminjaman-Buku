<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{url('/assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{url('/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{url('/assets/css/argon.css?v=1.2.0')}}" type="text/css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <!-- <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
                    <h6 class="h2 text-primary d-inline-block mb-0"><strong>PINJAM BUKU</strong></h6>
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->

                    @auth("peminjam")
                    <ul class="navbar-nav" id="sidebar">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('peminjaman')}}">
                                <i class="ni ni-bag-17 text-info"></i>
                                <span class="nav-link-text">Peminjaman</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pengembalian')}}">
                                <i class="ni ni-archive-2 text-default"></i>
                                <span class="nav-link-text">Pengembalian</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('daftar-buku')}}">
                                <i class="ni ni-book-bookmark text-success"></i>
                                <span class="nav-link-text">Daftar Buku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('daftar-penerbit')}}">
                                <i class="ni ni-single-copy-04 text-warning"></i>
                                <span class="nav-link-text">Daftar Penerbit</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('profil')}}">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Profil</span>
                            </a>
                        </li>
                    </ul>
                    @endauth

                    @auth("adm")
                    <ul class="navbar-nav" id="sidebar">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-dashboard')}}">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-daftar-pinjaman')}}">
                                <i class="ni ni-cart text-info"></i>
                                <span class="nav-link-text">Peminjaman</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-daftar-buku')}}">
                                <i class="ni ni-book-bookmark text-success"></i>
                                <span class="nav-link-text">Daftar Buku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-daftar-penerbit')}}">
                                <i class="ni ni-single-copy-04 text-warning"></i>
                                <span class="nav-link-text">Daftar Penerbit</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-kondisi-buku')}}">
                                <i class="ni ni-books text-default"></i>
                                <span class="nav-link-text">Kondisi Buku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-status-buku')}}">
                                <i class="ni ni-tag text-danger"></i>
                                <span class="nav-link-text">Status Buku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-status-pinjaman')}}">
                                <i class="ni ni-bag-17 text-info"></i>
                                <span class="nav-link-text">Status Pinjaman</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-register-admin')}}">
                                <i class="ni ni-badge text-yellow"></i>
                                <span class="nav-link-text">Register Admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-kelola-akun')}}">
                                <i class="ni ni-bullet-list-67 text-success"></i>
                                <span class="nav-link-text">Kelola Akun</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adm-profil')}}">
                                <i class="ni ni-single-02 text-default"></i>
                                <span class="nav-link-text">Profil</span>
                            </a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
                    <!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="Search" type="text">
                            </div>
                        </div>
                        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </form> -->
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown pr-3">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    @auth("peminjam")
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="{{asset('storage/'.Auth::guard('peminjam')->user()->foto)}}">
                                    </span>
                                    @endauth

                                    @auth("peminjam")
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{Auth::guard('peminjam')->user()->nama}}</span>
                                    </div>
                                    @endauth
                                    @auth("adm")
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{Auth::guard('adm')->user()->email}}</span>
                                    </div>
                                    @endauth
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Selamat Datang!</h6>
                                </div>
                                <!-- <a href="#!" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Pengaturan</span>
                                </a> -->
                                <div class="dropdown-divider"></div>
                                @auth("peminjam")
                                <a href="{{route('profil')}}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profil</span>
                                </a>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                                @endauth
                                @auth("adm")
                                <a href="{{route('adm-profil')}}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profil</span>
                                </a>
                                <form action="{{route('adm-logout')}}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page content -->
        <div class="container-fluid pb-6 mt-4 ">

            <div class="card">
                @yield('body')
            </div>
            <!-- Footer -->
            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center  text-lg-left  text-muted">
                            &copy; 2021 <a href="javascript:void(0)" class="font-weight-bold ml-1">Kelompok 17</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">Kelompok 17</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">Tentang Kami</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        var id_sidebar = document.getElementById("sidebar");
        var class_navlink = id_sidebar.getElementsByClassName("nav-link");
        for (var i = 0; i < class_navlink.length; i++) {
            class_navlink[i].addEventListener("click", function() {
                var current = id_sidebar.getElementsByClassName("active");
                if (current.length > 0) {
                    current[0].className = current[0].className.replace(" active", "");
                }
                this.className += " active";
            });
        }
    </script>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{url('/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('/assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{url('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{url('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <!-- Optional JS -->
    <script src="{{url('/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{url('/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{url('/assets/js/argon.js?v=1.2.0')}}"></script>
</body>

</html>