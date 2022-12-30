@extends('layout')

@auth("peminjam")
@section('title', 'Dashboard')
@endauth

@auth("adm")
@section('title', 'Admin | Dashboard')
@endauth

@section('body')
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            @auth('peminjam')
            <h3 class="mb-0">Dashboard</h3>
            @endauth

            @auth('adm')
            <h3 class="mb-0">Dashboard Admin</h3>
            @endauth
        </div>
    </div>
</div>

<div class="card-body">
    <h6 class="heading-small text-muted mb-4">Peminjaman Buku</h6>
    <div class="text-center">
        <label class="form-control-label text-center mb-1">Buku merupakan jendela ilmu</label>
    </div>
    <div class="text-center">
        <label class="form-control-label text-center mb-1">Membaca buku merupakan hal yang penting</label>
    </div>
    <div class="text-center">
        <label class="form-control-label text-center mb-1">Website ini menyediakan peminjaman berbagai jenis buku</label>
    </div>
</div>

<hr class="my-4" />

<div class="row">
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    @auth('adm')
                    <h5 class="card-title text-uppercase text-muted mb-0">Pemin-jaman</h5>
                    <span class="h2 font-weight-bold mb-0">{{$daftar_pinjaman}}</span>
                    @endauth

                    @auth('peminjam')
                    <h5 class="card-title text-uppercase text-muted mb-0">Pemin-jaman</h5>
                    <span class="h2 font-weight-bold mb-0">{{$peminjaman}}</span>
                    @endauth

                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-bag-17"></i>
                    </div>
                </div>
            </div>
            <div>
                @auth('adm')
                <a type="button" href="{{route('adm-daftar-pinjaman')}}" class="btn btn btn-info mt-4 text-white">Lihat</a>
                @endauth

                @auth('peminjam')
                <a type="button" href="{{route('peminjaman')}}" class="btn btn btn-info mt-4 text-white">Lihat</a>
                @endauth
            </div>
        </div>
    </div>
    @auth('peminjam')
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Pengem-balian</h5>
                    <span class="h2 font-weight-bold mb-0">{{$pengembalian}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                        <i class="ni ni-archive-2"></i>
                    </div>
                </div>
            </div>
            <div>
                <a type="button" href="{{route('daftar-buku')}}" class="btn btn btn-danger mt-4 text-white">Lihat</a>
            </div>
        </div>
    </div>
    @endauth
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Daftar Buku</h5>
                    <span class="h2 font-weight-bold mb-0">{{$daftar_buku}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                        <i class="ni ni-book-bookmark"></i>
                    </div>
                </div>
            </div>
            <div>
                @auth('adm')
                <a type="button" href="{{route('adm-daftar-buku')}}" class="btn btn btn-success mt-4 text-white">Lihat</a>
                @endauth

                @auth('peminjam')
                <a type="button" href="{{route('daftar-buku')}}" class="btn btn btn-success mt-4 text-white">Lihat</a>
                @endauth
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Daftar Penerbit</h5>
                    <span class="h2 font-weight-bold mb-0">{{$daftar_penerbit}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-gray text-white rounded-circle shadow">
                        <i class="ni ni-single-copy-04"></i>
                    </div>
                </div>
            </div>
            <div>
                @auth('adm')
                <a type="button" href="{{route('adm-daftar-penerbit')}}" class="btn btn btn-warning mt-4 text-white">Lihat</a>
                @endauth

                @auth('peminjam')
                <a type="button" href="{{route('daftar-penerbit')}}" class="btn btn btn-warning mt-4 text-white">Lihat</a>
                @endauth
            </div>
        </div>
    </div>

    @auth('adm')
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Kondisi Buku</h5>
                    <span class="h2 font-weight-bold mb-0">{{$kondisi_buku}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-books"></i>
                    </div>
                </div>
            </div>
            <div>
                <a type="button" href="{{route('adm-kondisi-buku')}}" class="btn btn btn-default mt-4 text-white">Lihat</a>
            </div>
        </div>
    </div>
    @endauth

    @auth('adm')
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Status Buku</h5>
                    <span class="h2 font-weight-bold mb-0">{{$status_buku}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-tag"></i>
                    </div>
                </div>
            </div>
            <div>
                <a type="button" href="{{route('adm-status-buku')}}" class="btn btn btn-danger mt-4 text-white">Lihat</a>
            </div>
        </div>
    </div>
    @endauth

    @auth('adm')
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Status Pinjaman</h5>
                    <span class="h2 font-weight-bold mb-0">{{$status_pinjaman}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                        <i class="ni ni-bag-17"></i>
                    </div>
                </div>
            </div>
            <div>
                <a type="button" href="{{route('adm-status-pinjaman')}}" class="btn btn btn-info mt-4 text-white">Lihat</a>
            </div>
        </div>
    </div>
    @endauth

    @auth('adm')
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Register Admin</h5>
                    <span class="h2 font-weight-bold mb-0">{{$register_admin}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-badge"></i>
                    </div>
                </div>
            </div>
            <div>
                <a type="button" href="{{route('adm-register-admin')}}" class="btn btn btn-default mt-4 text-white">Lihat</a>
            </div>
        </div>
    </div>
    @endauth

    @auth('adm')
    <div class="col-3">
        <div class=" card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0" style="margin-bottom: 24px;">Kelola Akun</h5>
                    <span class="h2 font-weight-bold mb-0">{{$kelola_akun}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                    </div>
                </div>
            </div>
            <div>

                <a type="button" href="{{route('adm-kelola-akun')}}" class="btn btn btn-success mt-4 text-white">Lihat</a>
            </div>
        </div>
    </div>
    @endauth
</div>
@endsection