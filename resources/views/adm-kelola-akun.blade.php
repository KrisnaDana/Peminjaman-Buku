@extends('layout')

@section('title', 'Admin | Kelola Akun')

@section('body')
<div class="card-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="mb-0">Kelola Akun</h3>
        </div>
        <div class="col-4 text-right">
            <a type="button" href="{{route('adm-kelola-akun-tambah')}}" class="btn btn-sm btn-primary text-white">Tambah</a>
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
                        <th scope="col" class="sort" data-sort="daftar">Waktu</th>
                        <th scope="col" class="sort" data-sort="daftar">Status</th>
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

                        <td class="text-start">
                            {{$daftars->created_at}}
                        </td>

                        <td class="text-center">
                            @if($daftars->status>0)
                            <img class="mx-0" style="max-width:20px; max-height:20px;" src="{{asset('storage/approved.jpg')}}">
                            @else
                            <img class="mx-0" style="max-width:20px; max-height:20px;" src="{{asset('storage/waiting.jpg')}}">
                            @endif
                        </td>


                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    @if($daftars->status == 0)
                                    <form action="{{route('adm-kelola-akun-approve', $daftars->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Approve</button>
                                    </form>
                                    @endif
                                    <a type="button" class="dropdown-item" href="{{route('adm-kelola-akun-detail', $daftars->id)}}">Detail</a>
                                    <a type="button" class="dropdown-item" href="{{route('adm-kelola-akun-ubah', $daftars->id)}}">Ubah</a>
                                    <form action="{{route('adm-kelola-akun-hapus', $daftars->id)}}" method="post">
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
            {{$daftar->links()}}
        </div>
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

@endsection