@extends('layout')

@auth('adm')
@section('title', 'Admin | Tambah Buku')
@endauth

@section('body')

@if(!empty($tambah))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-10">
            <h3 class="mb-0">Tambah Buku</h3>
        </div>
        <div class="col-auto">
            <a href="{{route('adm-daftar-pinjaman-detail', ['id' => $id, 'trx_id' => $trx_id])}}" type="button" class="btn btn-sm btn-danger" style="margin-left: 57px;">Kembali</a>
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
                        <th scope="col" class="sort" data-sort="daftar">Judul</th>
                        <th scope="col" class="sort" data-sort="daftar">Kode</th>
                        <th scope="col" class="sort" data-sort="daftar">Penerbit</th>
                        <th scope="col" class="sort" data-sort="daftar">Kondisi</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)

                    <tr>
                        <th scope="row"> {{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$daftars->judul}}
                        </td>

                        <td class="text-start">
                            {{$daftars->kode}}
                        </td>

                        <td class="text-start">
                            {{$daftars->buku_penerbit->penerbit}}
                        </td>

                        <td class="text-start">
                            {{$daftars->buku_kondisi->kondisi}}
                        </td>

                        <td class="text-right">
                            <a type="button" href="{{route('adm-daftar-pinjaman-detail-tambah-buku', ['id' => $id, 'trx_id' => $trx_id, 'buku_id' => $daftars->id])}}" class="btn btn-sm btn-primary">Pilih</a>
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

@if(!empty($detail))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-9">
            <h3 class="mb-0">Informasi Buku</h3>
        </div>
        <div class="text-end mr-2 ml-5">
            <form action="{{route('adm-daftar-pinjaman-detail-tambah-submit', ['id' => $id, 'trx_id' => $trx_id, 'buku_id' => $daftars->id])}}" method="post">
                @csrf
                <button type=" submit" class="btn btn-sm btn-primary ml-1 px-3">Pilih</button>
            </form>
        </div>
        <div class=" text-end">
            <a href="{{route('adm-daftar-pinjaman-detail-tambah', ['id' => $id, 'trx_id' => $trx_id])}}" type="button" class="btn btn-sm btn-danger">Kembali</a>
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