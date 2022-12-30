@extends('layout')

@auth('adm')
@section('title', 'Admin | Peminjaman')
@endauth

@auth('peminjam')
@section('title', 'Peminjaman')
@endauth

@section('body')

<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Daftar Peminjaman</h3>
        </div>
        @auth('adm')
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-pinjaman-tambah')}}" class="btn btn-sm btn-primary text-white">Tambah</a>
        </div>
        @endauth
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="id">No</th>
                        @auth('adm')
                        <th scope="col" class="sort" data-sort="daftar">Email Peminjam</th>
                        <th scope="col" class="sort" data-sort="daftar">Nama Peminjam</th>
                        @endauth
                        <th scope="col" class="sort" data-sort="daftar">Tanggal</th>
                        <th scope="col" class="sort" data-sort="daftar">Jumlah Buku</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)

                    <tr>
                        <th scope="row">{{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        @auth('adm')
                        <td class="text-start">
                            {{$daftars->peminjam->email}}
                        </td>
                        <td class="text-start">
                            {{$daftars->peminjam->nama}}
                        </td>
                        @endauth
                        <td class="text-start">
                            {{$daftars->tanggal}}
                        </td>

                        @php
                        $trx_detail = DB::table('trx_pinjaman_details')->where('trx_id', '=', $daftars->id)->get();
                        if(count($trx_detail) == '0'){
                        $jumlah = 0;
                        }else{
                        $jumlah = count($trx_detail);
                        }
                        @endphp

                        <td class="text-center">
                            {{$jumlah}}
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" type="button" href="{{route('adm-daftar-pinjaman-detail-info', ['id' => $daftars->peminjam->id, 'trx_id' => $daftars->id])}}">Detail</a>
                                    <a class="dropdown-item" type="button" href="{{route('adm-daftar-pinjaman-detail-pengembalian', ['id' => $daftars->peminjam->id, 'trx_id' => $daftars->id])}}">Pengembalian</a>
                                    @auth('adm')
                                    <form action="{{route('adm-daftar-pinjaman-hapus', $daftars->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Hapus</button>
                                    </form>
                                    @endauth
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$daftar->links()}}
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
</div>

@endsection