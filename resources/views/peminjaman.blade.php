@extends('layout')

@section('title', 'Peminjaman')

@section('body')

@if(!empty($detail))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Daftar Pinjaman Detail</h3>
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
                        <th scope="col" class="sort" data-sort="daftar">Judul Buku</th>
                        <th scope="col" class="sort" data-sort="daftar">Penerbit</th>
                        <th scope="col" class="sort" data-sort="daftar">Tanggal Pinjam</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)
                    <tr>
                        <th scope="row">{{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$daftars->judul}}
                        </td>
                        <td class="text-start">
                            {{$daftars->penerbit}}
                        </td>
                        <td class="text-center">
                            {{$daftars->tanggal}}
                        </td>
                        <td class="text-right">
                            <a type="button" href="{{route('peminjaman-buku', $daftars->id)}}" class="btn btn-sm btn-primary text-white px-3">Lihat</a>
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

@if(!empty($buku))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Informasi Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('peminjaman')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    <img class="card-img-top mb-4" style="max-width:200px; max-height:200px; border-radius:3%;" src="{{asset('storage/'.$daftars->foto_sampul)}}" alt="Card image cap">
    <div class="row">
        <div class="col-lg">
            <div class="form-group">
                <label class="form-control-label">Judul</label>
                <input type="text" id="judul" class="form-control" value="{{$daftars->judul}}" disabled readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Kode</label>
                <input type="text" id="kode" class="form-control" value="{{$daftars->kode}}" disabled readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Jumlah Halaman</label>
                <input type="text" id="halaman" class="form-control" value="{{$daftars->jumlah_halaman}}" disabled readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Pengarang</label>
                <input type="text" class="form-control" value="{{$daftars->pengarang}}" disabled readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Penerbit</label>
                <input type="text" class="form-control" value="{{$daftars->buku_penerbit->penerbit}}" disabled readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Tahun Terbit</label>
                <input type="text" class="form-control" value="{{$daftars->tahun_terbit}}" disabled readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Kondisi</label>
                <input type="text" class="form-control" value="{{$daftars->buku_kondisi->kondisi}}" disabled readonly>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Deskripsi</label>
        <textarea class="form-control" rows="3" disabled readonly>{{$daftars->deskripsi}}</textarea>
    </div>
</div>
@endif
@endsection