@extends('layout')

@auth('adm')
@section('title', 'Admin | Daftar Penerbit')
@endauth

@auth('peminjam')
@section('title', 'Daftar Penerbit')
@endauth

@section('body')

<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Daftar Penerbit</h3>
        </div>
        @auth('adm')
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-daftar-penerbit-tambah')}}" class="btn btn-sm btn-primary text-white">Tambah</a>
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
                        <th scope="col" class="sort" data-sort="daftar">Daftar Penerbit</th>
                        @auth('adm')
                        <th></th>
                        @endauth
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($daftar as $daftars)

                    <tr>
                        <th scope="row"> {{$loop->index+1+($daftar->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$daftars->penerbit}}
                        </td>
                        @auth('adm')
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a type="button" class="dropdown-item" href="{{route('adm-daftar-penerbit-ubah', $daftars->id)}}">Ubah</a>
                                    <!-- <form action="{{route('adm-daftar-penerbit-hapus', $daftars->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Ubah</button>
                                    </form> -->
                                    <form action="{{route('adm-daftar-penerbit-hapus', $daftars->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$daftar->links()}}
        </div>

    </div>
    @if ($message = Session::get('error'))
    <hr class="my-4" />
    <div class="alert alert-danger mt-3" role="alert">
        <strong>{{$message}}</strong>
    </div>
    @endif
</div>

@endsection