@extends('layout')

@section('title', 'Admin | Kondisi Buku')

@section('body')

<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Kondisi Buku</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-kondisi-buku-tambah')}}" class="btn btn-sm btn-primary text-white">Tambah</a>
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
                        <th scope="col" class="sort" data-sort="kondisi">Kondisi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($kondisi as $kondisis)
                    <tr>
                        <th scope="row"> {{$loop->index+1+($kondisi->currentPage()-1)*5}}</th>
                        <td class="text-start">
                            {{$kondisis->kondisi}}
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a type="button" class="dropdown-item" href="{{route('adm-kondisi-buku-ubah', $kondisis->id)}}">Ubah</a>
                                    <!-- <form action="{{route('adm-kondisi-buku-hapus', $kondisis->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Ubah</button>
                                    </form> -->
                                    <form action="{{route('adm-kondisi-buku-hapus', $kondisis->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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