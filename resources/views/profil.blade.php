@extends('layout')

@auth("peminjam")
@section('title', 'Profil')
@endauth

@auth("adm")
@section('title', 'Admin | Profil')
@endauth

@section('body')

@auth('adm')
<form action="{{route('adm-profil-ubah')}}" method="post">
    @endauth

    @auth('peminjam')
    <form action="{{route('profil-ubah')}}" method="post" enctype="multipart/form-data">
        @endauth

        @csrf
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Ubah Profil</h3>
                </div>
                <div class="col-4 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @auth('peminjam')
            <h6 class="heading-small text-muted mb-4">Profil Pengguna</h6>
            @endauth

            @auth('peminjam')
            <div class="pl-lg-4">
                @if(!empty($profil->foto))
                <img class="card-img-top mb-4" style="max-width:250px; max-height:250px; border-radius:3%;" src="{{asset('storage/'.$profil->foto)}}">
                @else
                <img class="card-img-top mb-4" style="max-width:250px; max-height:250px; border-radius:3%;" src="{{asset('storage/avatar.png')}}">
                @endif
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="nama">Nama</label>
                            <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" spellcheck="false" name="nama" value="{{old('nama') ?? $profil->nama}}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="alamat">Alamat</label>
                            <input type="text" id="alamat" class="form-control @error('alamat') is-invalid @enderror" spellcheck="false" name="alamat" value="{{old('alamat') ?? $profil->alamat}}" required>
                            @error('alamat')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="telepon">No Telepon</label>
                            <input type="text" id="telepon" class="form-control @error('telepon') is-invalid @enderror" name="telepon" spellcheck="false" required value="{{old('telepon') ?? $profil->telepon}}">
                            @error('telepon')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="tanggal">Tanggal Lahir</label>
                            <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" spellcheck="false" required value="{{old('tanggal') ?? $profil->tanggal_lahir}}">
                            @error('tanggal')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <label class="form-control-label" for="tanggal">Upload Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="customFileLang" name="foto">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                            @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4" />
            @endauth
            <!-- Address -->
            @auth('peminjam')
            <h6 class="heading-small text-muted mb-4">Akun Pengguna</h6>
            @endauth

            @auth('adm')
            <h6 class="heading-small text-muted mb-4">Akun Admin</h6>
            @endauth
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-md-12">
                        @auth('peminjam')
                        <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" value="{{$profil->email}}" type="email" spellcheck="false" readonly disabled>
                        </div>
                        @endauth

                        @auth('adm')
                        <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{$profil->email}}" value="{{$profil->email}}" type="email" spellcheck="false">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        @endauth
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="password">Password Baru</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan Jika Tidak Ingin Diubah" spellcheck="false">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="konfirmasi">Konfirmasi Password</label>
                            <input type="password" id="konfirmasi" name="konfirmasi" class="form-control @error('konfirmasi') is-invalid @enderror" placeholder="Kosongkan Jika Tidak Ingin Diubah" spellcheck="false">
                            @error('konfirmasi')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('error'))
            <hr class="my-4" />
            <div class="alert alert-danger mt-3" role="alert">
                <strong>{{$message}}</strong>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <hr class="my-4" />
            <div class="alert alert-success mt-3" role="alert">
                <strong>{{$message}}</strong>
            </div>
            @endif
        </div>
        @auth('peminjam')
    </form>
    @endauth

    @auth('adm')
</form>
@endauth


@endsection