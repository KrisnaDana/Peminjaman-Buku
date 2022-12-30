@extends('layout')

@auth('adm')
@section('title', 'Admin | Daftar Pinjaman Detail')
@endauth

@auth('peminjam')
@section('title', 'Daftar Pinjaman')
@endauth

@section('body')

@if(!empty($detail))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Daftar Pinjaman Detail</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-pinjaman-detail-tambah', ['id' => $trx->peminjam->id, 'trx_id' => $trx->id])}}" class="btn btn-sm btn-primary text-white">Tambah</a>
        </div>
    </div>
</div>
<div class="card-body">
    <h6 class="heading-small text-muted mb-0">{{$trx->peminjam->nama}}</h6>
    <h6 class="heading-small text-muted mb-0">{{$trx->peminjam->email}}</h6>
    <h6 class="heading-small text-muted mb-0">{{$trx->tanggal}}</h6>
    <hr class="my-4" />
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="id">No</th>
                        <th scope="col" class="sort" data-sort="daftar">Judul Buku</th>
                        <th scope="col" class="sort" data-sort="daftar">Kode</th>
                        <th scope="col" class="sort" data-sort="daftar">Penerbit</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)
                    <tr>
                        <th scope="row">{{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$daftars->buku->judul}}
                        </td>
                        <td class="text-start">
                            {{$daftars->buku->kode}}
                        </td>
                        <td class="text-start">
                            {{$daftars->buku->buku_penerbit->penerbit}}
                        </td>
                        <td class="text-center">
                            <form action="{{route('adm-daftar-pinjaman-detail-hapus', $daftars->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
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
        <div class="col-8">
            <h3 class="mb-0">Daftar Pinjaman Detail</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-pinjaman')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    @auth('adm')
    <h6 class="heading-small text-muted mb-0">{{$trx->peminjam->nama}}</h6>
    <h6 class="heading-small text-muted mb-0">{{$trx->peminjam->email}}</h6>
    @endauth
    <h6 class="heading-small text-muted mb-0">{{$trx->tanggal}}</h6>
    <hr class="my-4" />
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="id">No</th>
                        <th scope="col" class="sort" data-sort="daftar">Judul Buku</th>
                        <th scope="col" class="sort" data-sort="daftar">Kode</th>
                        <th scope="col" class="sort" data-sort="daftar">Penerbit</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)
                    <tr>
                        <th scope="row">{{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$daftars->buku->judul}}
                        </td>
                        <td class="text-start">
                            {{$daftars->buku->kode}}
                        </td>
                        <td class="text-start">
                            {{$daftars->buku->buku_penerbit->penerbit}}
                        </td>
                        <td class="text-right">
                            @auth('peminjam')
                            <a type="button" href="{{route('adm-daftar-pinjaman-detail-info-buku', ['id' => $trx->peminjam->id, 'trx_id' => $trx->id, 'buku_id' => $daftars->buku->id])}}" class="btn btn-sm btn-primary text-white px-3">Lihat</a>
                            @endauth
                            @auth('adm')
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a type="button" href="{{route('adm-daftar-pinjaman-detail-info-buku', ['id' => $trx->peminjam->id, 'trx_id' => $trx->id, 'buku_id' => $daftars->buku->id])}}" class="dropdown-item">Lihat Buku</a>
                                    @if($daftars->status_id == '1')
                                    <form action="{{route('adm-daftar-pinjaman-detail-dikembalikan', $daftars->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Dikembalikan</button>
                                    </form>
                                    @endif
                                    <form action="{{route('adm-daftar-pinjaman-detail-hapus', $daftars->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            @endauth
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
            <a type="button" href="{{route('adm-daftar-pinjaman-detail-info', ['id' => $id, 'trx_id' => $trx_id])}}" class="btn btn-sm btn-danger text-white">Kembali</a>
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

@if(!empty($kembali))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Daftar Pengembalian Detail</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-pinjaman')}}" class="btn btn-sm btn-danger text-white">Kembali</a>
        </div>
    </div>
</div>
<div class="card-body">
    @auth('adm')
    <h6 class="heading-small text-muted mb-0">{{$trx->peminjam->nama}}</h6>
    <h6 class="heading-small text-muted mb-0">{{$trx->peminjam->email}}</h6>
    @endauth
    <h6 class="heading-small text-muted mb-0">{{$trx->tanggal}}</h6>
    <hr class="my-4" />
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="id">No</th>
                        <th scope="col" class="sort" data-sort="daftar">Judul Buku</th>
                        <th scope="col" class="sort" data-sort="daftar">Kode</th>
                        <th scope="col" class="sort" data-sort="daftar">Penerbit</th>
                        <th scope="col" class="sort" data-sort="daftar">Kembali</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)
                    <tr>
                        <th scope="row">{{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$daftars->buku->judul}}
                        </td>
                        <td class="text-start">
                            {{$daftars->buku->kode}}
                        </td>
                        <td class="text-start">
                            {{$daftars->buku->buku_penerbit->penerbit}}
                        </td>
                        <td class="text-start">
                            {{$daftars->kembali}}
                        </td>
                        <td class="text-right">
                            <a type="button" href="{{route('adm-daftar-pinjaman-detail-pengembalian-buku', ['id' => $trx->peminjam->id, 'trx_id' => $trx->id, 'buku_id' => $daftars->buku->id])}}" class="btn btn-sm btn-primary text-white px-3">Lihat</a>
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

@if(!empty($kembali_buku))
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Informasi Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-pinjaman-detail-pengembalian', ['id' => $id, 'trx_id' => $trx_id])}}" class="btn btn-sm btn-danger text-white">Kembali</a>
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