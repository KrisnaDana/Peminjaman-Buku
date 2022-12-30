@extends('layout')

@auth('adm')
@section('title', 'Admin | Daftar Buku')
@endauth

@auth('peminjam')
@section('title', 'Daftar Buku')
@endauth

@section('body')

<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Daftar Buku</h3>
        </div>
        @auth('adm')
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-buku-tambah')}}" class="btn btn-sm btn-primary text-white">Tambah</a>
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
                        <th scope="col" class="sort" data-sort="daftar">Judul</th>
                        <th scope="col" class="sort" data-sort="daftar">Penerbit</th>
                        @auth("peminjam")
                        <th scope="col" class="sort" data-sort="daftar">Tahun</th>
                        <th scope="col" class="sort" data-sort="daftar">Halaman</th>
                        @endauth

                        @auth('adm')
                        <th scope="col" class="sort" data-sort="daftar">Kondisi</th>
                        <th scope="col" class="sort" data-sort="daftar">Status</th>
                        @endauth
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
                            {{$daftars->buku_penerbit->penerbit}}
                        </td>

                        @auth("peminjam")
                        <td class="text-start">
                            {{$daftars->tahun_terbit}}
                        </td>

                        <td class="text-start">
                            {{$daftars->jumlah_halaman}}
                        </td>
                        @endauth


                        @auth('adm')
                        <td class="text-start">
                            {{$daftars->buku_kondisi->kondisi}}
                        </td>

                        <td class="text-start">
                            {{$daftars->buku_status->status}}
                        </td>
                        @endauth


                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    @auth("peminjam")
                                    <a type="button" class="dropdown-item" href="{{route('daftar-buku-detail', $daftars->id)}}">Detail</a>
                                    @endauth
                                    @auth('adm')
                                    <a type="button" class="dropdown-item" href="{{route('adm-daftar-buku-detail', $daftars->id)}}">Detail</a>
                                    <a type="button" class="dropdown-item" href="{{route('adm-daftar-buku-ubah', $daftars->id)}}">Ubah</a>
                                    <form action="{{route('adm-daftar-buku-hapus', $daftars->id)}}" method="post">
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

    </div>
</div>

@endsection