@extends('layout')

@section('title', 'Admin | Daftar Peminjaman')

@section('body')

@if (!empty($tambah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Tambah Peminjaman</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-pinjaman')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="id">No</th>
                        <th scope="col" class="sort" data-sort="daftar">Email</th>
                        <th scope="col" class="sort" data-sort="daftar">Nama</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)

                    <tr>
                        <th scope="row"> {{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$daftars->email}}
                        </td>

                        <td class="text-start">
                            {{$daftars->nama}}
                        </td>

                        <td class="text-center">
                            <a type="button" class="btn btn-sm btn-primary px-4" href="{{route('adm-daftar-pinjaman-tambah-info', $daftars->id)}}">Pilih</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$daftar->links()}}
        </div>
    </div>
</div>
@endif

@if(!empty($info))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-9">
            <h3 class="mb-0">Informasi Pengguna</h3>
        </div>
        <div class="text-end mr-2 ml-5">
            <a type="button" href="{{route('adm-daftar-pinjaman-transaksi', $profil->id)}}" class="btn btn-sm btn-primary ml-1 px-3">Pilih</a>
        </div>
        <div class=" text-end">
            <a href="{{route('adm-daftar-pinjaman-tambah')}}" type="button" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <h6 class="heading-small text-muted mb-4">Profil Pengguna</h6>
    <div class="pl-lg-4">
        @if(!empty($profil->foto))
        <img class="card-img-top mb-4" style="max-width:250px; max-height:250px; border-radius:3%;" src="{{asset('storage/'. $profil->foto)}}">
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

@endsection