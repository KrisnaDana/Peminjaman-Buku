@extends('layout')

@section('title', 'Admin | Kelola Akun')

@section('body')

@if(!empty($tambah))
<form action="{{route('adm-kelola-akun-tambah-submit')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-9">
                <h3 class="mb-0">Tambah Akun</h3>
            </div>
            <div class="text-end mr-2 ml-5">
                <button type="submit" class="btn btn-sm btn-primary ml-1">Simpan</button>
            </div>
            <div class=" text-end">
                <a href="{{route('adm-kelola-akun')}}" type="button" class="btn btn-sm btn-danger me-3">Kembali</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h6 class="heading-small text-muted mb-4">Profil Pengguna</h6>

        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="nama">Nama</label>
                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" spellcheck="false" name="nama" value="{{old('nama')}}" placeholder="Masukkan Nama" required>
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="alamat">Alamat</label>
                        <input type="text" id="alamat" class="form-control @error('alamat') is-invalid @enderror" spellcheck="false" name="alamat" placeholder="Masukkan Alamat" value="{{old('alamat')}}" required>
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
                        <input type="text" id="telepon" class="form-control @error('telepon') is-invalid @enderror" name="telepon" spellcheck="false" placeholder="Masukkan No Telepon" required value="{{old('telepon')}}">
                        @error('telepon')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="tanggal">Tanggal Lahir</label>
                        <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" spellcheck="false" required value="{{old('tanggal')}}" placeholder="Masukkan Tanggal">
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

        <h6 class="heading-small text-muted mb-4">Akun Pengguna</h6>
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label" for="email">Email</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" value="{{old('email')}}" type="email" spellcheck="false" required>
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" spellcheck="false" required>
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="konfirmasi">Konfirmasi Password</label>
                        <input type="password" id="konfirmasi" name="konfirmasi" class="form-control @error('konfirmasi') is-invalid @enderror" placeholder="Masukkan Konfirmasi Password" spellcheck="false" required>
                        @error('konfirmasi')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @if ($message = Session::get('danger'))
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
</form>
@endif

@if(!empty($detail))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Detail Akun</h3>
        </div>
        <div class="col-4 text-right">
            <a href="{{route('adm-kelola-akun')}}" type="button" class="btn btn-sm btn-danger me-3">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <h6 class="heading-small text-muted mb-4">Profil Pengguna</h6>
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
                    <input type="text" id="nama" class="form-control" value="{{$profil->nama}}" readonly disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="alamat">Alamat</label>
                    <input type="text" id="alamat" class="form-control" value="{{$profil->alamat}}" readonly disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="telepon">No Telepon</label>
                    <input type="text" id="telepon" class="form-control" value="{{$profil->telepon}}" readonly disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="tanggal">Tanggal Lahir</label>
                    <input type="date" id="tanggal" class="form-control" value="{{$profil->tanggal_lahir}}" readonly disabled>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4" />

    <h6 class="heading-small text-muted mb-4">Akun Pengguna</h6>
    <div class="pl-lg-4">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label" for="email">Email</label>
                    <input id="email" class="form-control" name="email" value="{{$profil->email}}" type="email" readonly disabled>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(!empty($ubah))
<form action="{{route('adm-kelola-akun-ubah-submit', $profil->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-9">
                <h3 class="mb-0">Ubah Akun</h3>
            </div>
            <div class="text-end mr-2 ml-5">
                <button type="submit" class="btn btn-sm btn-primary ml-1">Simpan</button>
            </div>
            <div class=" text-end">
                <a href="{{route('adm-kelola-akun')}}" type="button" class="btn btn-sm btn-danger me-3">Kembali</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h6 class="heading-small text-muted mb-4">Profil Pengguna</h6>

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

        <h6 class="heading-small text-muted mb-4">Akun Pengguna</h6>
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label" for="email">Email</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" value="{{$profil->email}}" type="email" spellcheck="false" readonly disabled>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="email">Email</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{$profil->email}}" value="{{$profil->email}}" type="email" spellcheck="false">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
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
        @if ($message = Session::get('danger'))
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
</form>
@endif
@endsection