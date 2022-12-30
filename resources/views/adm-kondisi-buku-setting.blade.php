@extends('layout')

@section('title', 'Admin | Kondisi Buku')

@section('body')

@if (!empty($tambah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Tambah Kondisi Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-kondisi-buku')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-kondisi-buku-tambah-submit')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <label class="form-control-label" for="kondisi">Jenis Kondisi</label>
                    <input type="text" id="nama" class="form-control @error('kondisi') is-invalid @enderror" placeholder="Masukkan Jenis Kondisi" spellcheck="false" name="kondisi" required>
                    @error('kondisi')
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
            <h3 class="mb-0">Ubah Kondisi Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-kondisi-buku')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-kondisi-buku-ubah-submit', $kondisis->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <label class="form-control-label" for="kondisi">Jenis Kondisi</label>
                    <input type="text" id="nama" class="form-control @error('kondisi') is-invalid @enderror" placeholder="{{$kondisis->kondisi}}" value="{{$kondisis->kondisi}}" spellcheck="false" name="kondisi" required>
                    @error('kondisi')
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