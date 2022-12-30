@extends('layout')

@section('title', 'Admin | Daftar Penerbit')

@section('body')

@if (!empty($tambah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Tambah Penerbit Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-penerbit')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-daftar-penerbit-tambah-submit')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <label class="form-control-label" for="daftar">Nama Penerbit</label>
                    <input type="text" id="nama" class="form-control @error('daftar') is-invalid @enderror" placeholder="Masukkan Penerbit Buku" spellcheck="false" name="daftar" required>
                    @error('daftar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-2 text-left">
                <button type="submit" class="btn btn-primary" style="margin-top:40px;">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endif

@if (!empty($ubah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Ubah Penerbit Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-penerbit')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-daftar-penerbit-ubah-submit', $daftars->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <label class="form-control-label" for="daftar">Nama Penerbit</label>
                    <input type="text" id="nama" class="form-control @error('daftar') is-invalid @enderror" placeholder="{{$daftars->penerbit}}" value="{{$daftars->penerbit}}" spellcheck="false" name="daftar" required>
                    @error('daftar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-2 text-right">
                <button type="submit" class="btn btn-primary" style="margin-top:40px;">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endif

@endsection