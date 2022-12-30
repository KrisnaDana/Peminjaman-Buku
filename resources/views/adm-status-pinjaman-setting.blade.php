@extends('layout')

@section('title', 'Admin | Status Pinjaman')

@section('body')

@if (!empty($tambah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Tambah Status Pinjaman</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-status-pinjaman')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-status-pinjaman-tambah-submit')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <label class="form-control-label" for="status">Jenis Status</label>
                    <input type="text" id="nama" class="form-control @error('status') is-invalid @enderror" placeholder="Masukkan Jenis status" spellcheck="false" name="status" required>
                    @error('status')
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
            <h3 class="mb-0">Ubah Status Pinjaman</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-status-pinjaman')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form action="{{route('adm-status-pinjaman-ubah-submit', $statuss->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <label class="form-control-label" for="status">Jenis Status</label>
                    <input type="text" id="nama" class="form-control @error('status') is-invalid @enderror" placeholder="{{$statuss->status}}" value="{{$statuss->status}}" spellcheck="false" name="status" required>
                    @error('status')
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
@if ($message = Session::get('error'))
<hr class="my-4" />
<div class="alert alert-danger mt-3" role="alert">
    <strong>{{$message}}</strong>
</div>
@endif
@endif

@endsection